<?php

namespace App\Http\Controllers\Pagos;

use App\Transaccion;
use App\Catalogo;
use App\Cliente;
use App\TransaccionDetalle;
use App\VentaDetalle;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagosController extends Controller
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
        $pagado = TransaccionDetalle::SumaPagada(Session::get('id'));
        $resumen = VentaDetalle::getTotalVenta($id);
        return view('admin.pagos.list',compact('Lista','pagado','resumen'));
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
    public function store(Request $request)
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
            $venta = Transaccion::findOrFail(Session::get('id'));
            $venta->idestado=12;
            $venta->save();
            $this->updatePagoTotal();
            return redirect()->back()->with('success','Ha cancelado el total de su deuda');
        } elseif ($debe<0) {
            return redirect()->back()->with('success','El pago exede en total a lo vendido no se puede registrar');
        } else{
            $transactionDetails = new TransaccionDetalle($data);
            $transactionDetails->save();

            $this->cambiaestadotransaccion(13);
            $this->updatePagoTotal();

            return redirect()->back()->with('success','Se ha registrado el pago satisfactoriamente');
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
        $pago = TransaccionDetalle::findOrFail($id);
        return view('admin.pagos.delete',compact('pago'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pago = TransaccionDetalle::findOrFail($id);
        return view('admin.pagos.edit',compact('pago'));
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
        $pago = TransaccionDetalle::findOrFail($id);
        $pago->fill($request->all());
        $pago->save();
        return redirect()->route('pagos.list',$pago->idtransaccion)
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
        $pago = TransaccionDetalle::findOrFail($id)->toArray();
        $debe = $this->calculodeudaactual();

        if ($debe==0)$this->cambiaestadotransaccion(12);
        else $this->cambiaestadotransaccion(13);

        $this->updatePagoTotal();

        TransaccionDetalle::destroy($id);
        return redirect()->route('pagos.list',Session::get('id'))
                         ->with('success','Se ha Eliminado satisfactoriamente');
    }
    /**
     * Calcula deuda descontando la cuota ingresada
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function calculodeuda($data)
    {
        $TotalVendido = VentaDetalle::getTotalVenta(Session::get('id'));
        $pagado = TransaccionDetalle::SumaPagada(Session::get('id'));
        $debe = $TotalVendido[0]['total']-$pagado[0]['suma'];
        $debe -= $data['entrada'];
        return $debe;
    }
    /**
     * Cambia estado la transaccion
     * @param  integer $idestado estado a cambiar
     * @return null           no devuelve valor
     */
    public function cambiaestadotransaccion($idestado)
    {
        $prestamo = Transaccion::findOrFail(Session::get('id'));
        $prestamo->idestado=$idestado;
        $prestamo->save();
    }
    /**
     * Actualiza el monto pagado en transaccion
     * @return [type] [description]
     */
    public function updatePagoTotal()
    {
        $pagado = TransaccionDetalle::SumaPagada(Session::get('id'));
        $venta = Transaccion::findOrFail(Session::get('id'));
        $venta->monto=$pagado[0]['suma'];
        $venta->save();
    }
    /**
     * Calcula la deuda actual sin la cuota a eliminar
     * @return [type] [description]
     */
    public function calculodeudaactual()
    {
        $prestamo = Transaccion::findOrFail(Session::get('id'));
        $pagado = TransaccionDetalle::SumaPagada(Session::get('id'));
        $debe = $prestamo->Total-$pagado[0]['suma'];
        return $debe;
    }
}
