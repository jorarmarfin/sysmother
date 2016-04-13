<?php

namespace App\Http\Controllers\Cuotas;

use App\Transaccion;
use App\Catalogo;
use App\Cliente;
use App\TransaccionDetalle;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Requests\CuotaRequest;
use App\Http\Controllers\Controller;

class CuotasController extends Controller
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
        return view('admin.cuotas.list',compact('Lista','pagado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CuotaRequest $request)
    {
        $date = Carbon::now();
        $data = $request->all();
        $data['idtransaccion']=Session::get('id');
        $data['salida']=0;
        $data['fecha']=$date->toDateString('d-m-Y');;
        $data['hora']=$date->toTimeString();

        $debe = $this->calculodeuda($data);

        if ($debe==0) {
            $transactionDetails = new TransaccionDetalle($data);
            $transactionDetails->save();
            $prestamo = Transaccion::findOrFail(Session::get('id'));
            $prestamo->idestado=12;
            $prestamo->save();

            return redirect()->back()->with('success','Ha cancelado el total de su deuda');
        } elseif ($debe<0) {
            return redirect()->back()->with('success','La cuota exede en total a lo prestado no se puede registrar');
        } else{
            $transactionDetails = new TransaccionDetalle($data);
            $transactionDetails->save();

            $this->cambiaestadotransaccion(13);

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
        $cuota = TransaccionDetalle::findOrFail($id);
        return view('admin.cuotas.delete',compact('cuota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cuota = TransaccionDetalle::findOrFail($id);
        return view('admin.cuotas.edit',compact('cuota'));
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
        $cuota = TransaccionDetalle::findOrFail($id);
        $cuota->fill($request->all());
        $cuota->save();
        return redirect()->route('cuotas.list',$cuota->idtransaccion)
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
        $cuota = TransaccionDetalle::findOrFail($id)->toArray();
        $debe = $this->calculodeudaactual();

        if ($debe==0)$this->cambiaestadotransaccion(12);
        else $this->cambiaestadotransaccion(13);

        TransaccionDetalle::destroy($id);
        return redirect()->route('cuotas.list',Session::get('id'))
                         ->with('success','Se ha Eliminado satisfactoriamente');
    }
    /**
     * Calcula deuda descontando l acuota ingresada
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function calculodeuda($data)
    {
        $prestamo = Transaccion::findOrFail(Session::get('id'));
        $pagado = TransaccionDetalle::SumaPagada(Session::get('id'));
        $debe = $prestamo->Total-$pagado[0]['suma'];
        $debe -= $data['entrada'];
        return $debe;
    }

    public function calculodeudaactual()
    {
        $prestamo = Transaccion::findOrFail(Session::get('id'));
        $pagado = TransaccionDetalle::SumaPagada(Session::get('id'));
        $debe = $prestamo->Total-$pagado[0]['suma'];
        return $debe;
    }

    public function cambiaestadotransaccion($idestado)
    {
        $prestamo = Transaccion::findOrFail(Session::get('id'));
        $prestamo->idestado=$idestado;
        $prestamo->save();
    }
}
