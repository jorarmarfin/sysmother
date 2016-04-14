<?php

namespace App\Http\Controllers\Amortizacion;

use App\Transaccion;
use App\Catalogo;
use App\Cliente;
use App\TransaccionDetalle;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Requests\AmortizacionRequest;
use App\Http\Controllers\Controller;

class AmortizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        Session::put('id', $id);
        $transaction = Transaccion::findOrFail($id);
        $idtipo = $transaction->idtipo;
        $Lista = Transaccion::getCuotas($idtipo,$id);
        foreach ($Lista as $row)$row->Total=$row->Total;
        $raw = \DB::raw("SUBSTRING(codigo,3,4)");
        $pagado = TransaccionDetalle::SumaPagada(Session::get('id'));
        return view('admin.amortizacion.list',compact('Lista','pagado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AmortizacionRequest $request)
    {
        $transaction = Transaccion::findOrFail(Session::get('id'));
        if ($transaction->idestado==16) {
            return redirect()->back()->with('danger','No se puede amortizar una cuenta cerrada');
        } else {
            $date = Carbon::now();
            $data = $request->all();
            $data['idtransaccion']=Session::get('id');
            $data['salida']=0;
            $data['fecha']=$date->toDateString('d-m-Y');;
            $data['hora']=$date->toTimeString();
            $transactionDetails = new TransaccionDetalle($data);
            $transactionDetails->save();
            $this->updateTotal($transactionDetails->idtransaccion);
            return redirect()->back()->with('success','Se ha registrado la cuota satisfactoriamente');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $amortizacion = TransaccionDetalle::findOrFail($id);
        return view('admin.amortizacion.delete',compact('amortizacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $amortizacion = TransaccionDetalle::findOrFail($id);
        return view('admin.amortizacion.edit',compact('amortizacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $amortizacion = TransaccionDetalle::findOrFail($id);
        $amortizacion->fill($request->all());
        $amortizacion->save();
        $this->updateTotal($amortizacion->idtransaccion);
        return redirect()->route('amortizacion.list',$amortizacion->idtransaccion)
                         ->with('success','Se ha editado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idtransaccion = Session::get('id');
        $amortizacion = TransaccionDetalle::findOrFail($id)->toArray();
        TransaccionDetalle::destroy($id);
        $this->updateTotal($idtransaccion);
        return redirect()->route('amortizacion.list',$idtransaccion)
                         ->with('success','Se ha Eliminado satisfactoriamente');
    }

    public function updateTotal($id)
    {
        $transaction = Transaccion::findOrFail($id);
        $transaction->monto=TransaccionDetalle::SumaPagada($transaction->id)[0]['suma'];
        $transaction->save();
    }
}
