<?php

namespace App\Http\Controllers\VentaDetalle;

use App\VentaDetalle;
use App\Producto;
use App\Transaccion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use PDF;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class VentaDetalleController extends Controller
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
        $Lista = Transaccion::getVentaDetalle($idtipo,$id);
        $resumen = VentaDetalle::getTotalVenta($id);
        $products = Producto::where('activo','1')->orderBy('nombre')->get()->lists('nombre','id')->toarray();
        return view('admin.ventadetalle.list',compact('Lista','resumen','products'));

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
    public function store(Request $request)
    {
        $date = Carbon::now();
        $data = $request->all();
        $data['idtransaccion']=Session::get('id');
        $data['fecha']=$date->toDateString('d-m-Y');;
        $data['hora']=$date->toTimeString();
        $ventadetalle = new VentaDetalle($data);
        $ventadetalle->save();
        $venta = Transaccion::findOrFail(Session::get('id'));
        $venta->idestado=13;
        $venta->save();
        return redirect()->back()->with('success','Se ha registrado la venta satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ventadetalle = VentaDetalle::findOrFail($id);
        $products = Producto::all()->lists('nombre','id')->toarray();
        return view('admin.ventadetalle.delete',compact('ventadetalle','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Producto::all()->lists('nombre','id')->toarray();
        $ventadetalle = VentaDetalle::findOrFail($id);
        return view('admin.ventadetalle.edit',compact('ventadetalle','products'));
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
        $ventadetalle = VentaDetalle::findOrFail($id);
        $ventadetalle->fill($request->all());
        $ventadetalle->save();
        $venta = Transaccion::findOrFail(Session::get('id'));
        return redirect()->route('ventadetalle.list',$ventadetalle->idtransaccion)
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
        ventadetalle::destroy($id);
        return redirect()->route('ventadetalle.list',Session::get('id'))
                         ->with('success','Se ha eliminado satisfactoriamente');
    }

    /**
     * Muestra la vista que cargara el pdf
     * @return [type] [description]
     */
    public function imprimir()
    {
        $id = Session::get('id');
        return view('admin.ventadetalle.print',compact('id'));
    }

    public function showpdf()
    {
        // Preparo la data
        $id = Session::get('id');
        $transaction = Transaccion::findOrFail($id);
        $idtipo = $transaction->idtipo;
        $data = Transaccion::getVentaDetalle($idtipo,$id)->toArray();
        $resumen = VentaDetalle::getTotalVenta($id)->toArray();
        // Reporte PDF
        PDF::SetTitle('Detalle de venta');
        PDF::AddPage();
        // PDF::Write(0, 'Hello World');
            $this->header();
        #TITULO REPORTE
            PDF::SetXY(25,28);
            PDF::SetTextColor(255,0,0);
            PDF::SetFont('helvetica','B',12);
            PDF::Cell(150,5,'Detalle de venta',0,2,'C');
            PDF::SetTextColor(0);
        #DATOS ADICIONALES
            PDF::SetXY(20,40);
            PDF::SetFont('helvetica', '', 14);
            PDF::Cell(100, 5, 'Cliente : '.$data[0]['cliente'], 0, 1, 'L');
        #CABECERA DE DATA
            $this->TituloReporte();
        #DATA
            $pagina = 0;
            $lineaActual = 0;
            $numMaxLineas = 45;

            $altodecelda=5;
            $incremento = 50;
            $x = 10;
            $i = 0;
            $j = 1;
            $k = 1;
            while ($i < count($data)) {
                PDF::SetXY($x+10,$j*$altodecelda+$incremento);
                PDF::SetFont('helvetica', '', 9);
                PDF::Cell(10, 5, $k, 1, 1, 'C');
                #
                PDF::SetXY($x+20,$j*$altodecelda+$incremento);
                PDF::SetFont('helvetica', '', 9);
                PDF::Cell(60, 5, $data[$i]['producto'], 1, 1, 'L');
                #
                PDF::SetXY($x+80,$j*$altodecelda+$incremento);
                PDF::SetFont('helvetica', '', 9);
                PDF::Cell(20, 5, $data[$i]['cantidad'], 1, 1, 'C');
                #
                PDF::SetXY($x+100,$j*$altodecelda+$incremento);
                PDF::SetFont('helvetica', '', 9);
                PDF::Cell(20, 5, $data[$i]['precio'], 1, 1, 'R');
                #
                PDF::SetXY($x+120,$j*$altodecelda+$incremento);
                PDF::SetFont('helvetica', '', 9);
                PDF::Cell(20, 5, $data[$i]['cantidad']*$data[$i]['precio'], 1, 1, 'R');



                $i++;
                $j++;
                $k++;


            }//cierre del while

                #TOTAL
                PDF::SetXY($x+10,$j*$altodecelda+$incremento);
                PDF::SetFont('helvetica', 'B', 9);
                PDF::Cell(110, 5, 'TOTAL', 1, 1, 'C');
                #
                PDF::SetXY($x+120,$j*$altodecelda+$incremento);
                PDF::SetFont('helvetica', 'B', 9);
                PDF::Cell(20, 5, $resumen[0]['total'], 1, 1, 'R');

        PDF::Output('hello_world.pdf');
    }
    /**
     * Configura el titulo del reporte
     */
    public function TituloReporte()
    {
        #TITULO DE COLUMNAS
            $ejex=10;
            $ejey=50;

            PDF::SetTextColor(0);
            PDF::SetXY($ejex+10, $ejey);
            PDF::SetFont('helvetica', 'B', 11);
            PDF::Cell(10, 5, 'Nº', 1, 1, 'C');
            #
            PDF::SetXY($ejex+20, $ejey);
            PDF::SetFont('helvetica', 'B', 11);
            PDF::Cell(60, 5, 'Producto', 1, 1, 'C');
            // PDF::MultiCell(20,10,'Código Errado', 1, 'C', 1, 1, '' ,'', true,0,false,true,0,'T');
            #
            PDF::SetXY($ejex+80, $ejey);
            PDF::SetFont('helvetica', 'B', 11);
            PDF::Cell(20, 5, 'Cantidad', 1, 1, 'C');
            #
            PDF::SetXY($ejex+100, $ejey);
            PDF::SetFont('helvetica', 'B', 11);
            PDF::Cell(20, 5, 'Precio', 1, 1, 'C');
            #
            PDF::SetXY($ejex+120, $ejey);
            PDF::SetFont('helvetica', 'B', 11);
            PDF::Cell(20, 5, 'total', 1, 1, 'C');
    }
    public function header()
    {
        #NUMERO DE PAGINA
            PDF::SetFont('helvetica', 'B', 8);
            PDF::SetXY(160, 10);
            PDF::Cell(13, 5, "Fecha :", 0, 0, 'L');
            PDF::SetXY(173, 10);
            PDF::Cell(17, 5, date('d/m/Y'), 0, 0, 'R');
            PDF::SetXY(160, 13);
            PDF::Cell(13, 5, "Hora :", 0, 0, 'L');
            PDF::SetXY(173, 13);
            PDF::Cell(17, 5, date('H:i:s'), 0, 0, 'R');
            PDF::SetXY(160, 17);
            PDF::Cell(13, 5, 'Página :', 0, 0, 'L');
            PDF::SetXY(173, 17);
            $pagina = trim(PDF::PageNo().' de '.PDF::getAliasNbPages());
            PDF::Cell(17, 5,$pagina, 0, 0, 'R');
    }
}
