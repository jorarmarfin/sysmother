<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Transaccion extends Model
{
    protected $table = 'transaccion';
    protected $fillable = ['idcliente','idtipo','fecha','hora','monto','interes','idestado','idlugar'];
    protected $hidden = ['remember_token','idcliente','idtipo','idestado'];
    protected $guarded = [];
    // public $timestamps = false;
    /**
     * Propiedad que calcula el total
     * @return [type] [description]
     */
    public function getTotalAttribute()
    {
        $incremento =$this->monto*($this->interes/100);

        return $this->monto+$incremento;
    }
    /**
     * Relacion con la tabla transaccion detalle
     * @return [type] [description]
     */
    public function transacciondetalle()
    {
        return $this->hasMany('App\TransaccionDetalle','idtransaccion','id');
    }
    /**
     * Relacion con la tabla venta detalle
     * @return [type] [description]
     */
    public function ventadetalle()
    {
        return $this->hasMany('App\VentaDetalle','idtransaccion','id');
    }
    /**
     * Relacion con la tabla venta detalle y producto
     * @return [type] [description]
     */
    public function producto()
    {
        return $this->belongsToMany('App\Producto', 'venta_detalle', 'idtransaccion', 'idproducto');
    }
    #####################################################################
	public function scopegetTransaccion($cadenaSQL,$id)
    {
		return $cadenaSQL->select(
                                'transaccion.*',
                                'cliente.nombres',
                                'catalogo.nombre as estado'
                                )
                            ->join('cliente', 'cliente.id', '=', 'transaccion.idcliente')
                            ->join('catalogo', 'catalogo.id', '=', 'transaccion.idestado')
                            ->where('idtipo',$id)
                            ->orderBy('id','desc')->get();
	}
    /**
     * Trae las cuotas de un prestamo
     * @param  string $cadenaSQL consulta
     * @param  idtipo $id        tipo de transaccion
     * @return string            lista las cuotas
     */
    public function scopegetCuotas($cadenaSQL,$idtipo,$id){
        return $cadenaSQL->select(
                                'transaccion.*',
                                'cliente.nombres',
                                'catalogo.nombre as estado',
                                'cliente.foto'
                                )
                            ->join('cliente', 'cliente.id', '=', 'transaccion.idcliente')
                            ->join('catalogo', 'catalogo.id', '=', 'transaccion.idestado')
                            ->where('idtipo',$idtipo)
                            ->where('transaccion.id',$id)
                            ->with('transacciondetalle')
                            ->get();
    }
    /**
     * Trae las cuotas de un prestamo
     * @param  string $cadenaSQL consulta
     * @param  idtipo $id        tipo de transaccion
     * @return string            lista las cuotas
     */
    public function scopegetVentaDetalle($cadenaSQL,$idtipo,$id)
    {
        return $cadenaSQL->select(
                                'transaccion.*',
                                'venta_detalle.id',
                                'cliente.nombres as cliente',
                                'producto.nombre as producto',
                                'venta_detalle.cantidad',
                                'producto.precio_venta as precio',
                                'venta_detalle.fecha',
                                'venta_detalle.hora'
                                )
                         ->leftJoin('venta_detalle','venta_detalle.idtransaccion','=','transaccion.id')
                         ->leftJoin('producto','producto.id','=','venta_detalle.idproducto')
                         ->leftJoin('cliente','cliente.id','=','transaccion.idcliente')
                         ->where('idtipo',$idtipo)
                         ->where('transaccion.id',$id)
                         ->get();
    }

    public function scopegetVentas($cadenaSQL,$id)
    {
        return $cadenaSQL->select(
                                    'transaccion.id',
                                    'cliente.nombres as cliente',
                                    'transaccion.monto as pagado',
                                    'transaccion.fecha',
                                    'transaccion.hora',
                                    'e.nombre as estado',
                                    'l.nombre as lugar',
                                    DB::raw('sum(venta_detalle.cantidad*producto.precio_venta) as vendido')
                                 )
                         ->leftJoin('venta_detalle','venta_detalle.idtransaccion','=','transaccion.id')
                         ->leftJoin('producto','producto.id','=','venta_detalle.idproducto')
                         ->leftJoin('cliente','cliente.id','=','transaccion.idcliente')
                         ->leftJoin('catalogo as e', 'e.id', '=', 'transaccion.idestado')
                         ->leftJoin('catalogo as l', 'l.id', '=', 'transaccion.idlugar')
                         ->where('idtipo',$id)
                         ->orderBy('transaccion.id','desc')
                         ->groupBy('id','cliente','pagado','fecha','hora','estado')
                         ->get();
    }

    public function scopegetCantidad($cadenaSQL,$tipo,$estado)
    {
        return $cadenaSQL->select(
                                    DB::raw('count(*) as cnt')
                                 )
                         ->leftJoin('catalogo as tt','tt.id','=','transaccion.idtipo')
                         ->leftJoin('catalogo as e','e.id','=','transaccion.idestado')
                         ->where('tt.nombre',$tipo)
                         ->where('e.nombre',$estado)
                         ->get();
    }
    /**
     * Detalle de las cuentas
     * @param  [type] $cadenaSQL [description]
     * @param  [type] $idtipo    [description]
     * @param  [type] $id        [description]
     * @return [type]            [description]
     */
    public function scopegetDetalleCuentas($cadenaSQL,$id)
    {
        return $cadenaSQL->select(
                                'td.id',
                                'c.nombres as cliente',
                                'td.entrada',
                                'td.salida',
                                'td.fecha',
                                'td.hora'
                                )
                         ->leftJoin('transaccion_detalle as td','td.idtransaccion','=','transaccion.id')
                         ->Join('cliente as c','c.id','=','transaccion.idcliente')
                         ->where('transaccion.id',$id)
                         ->get();
    }

    public function scopegetTotalDetalleCuentas($cadenaSQL,$id)
    {
        return $cadenaSQL->select(
                                DB::raw('sum(td.entrada) as sumcobro'),
                                DB::raw('sum(td.salida) as sumventa')
                                )
                         ->leftJoin('transaccion_detalle as td','td.idtransaccion','=','transaccion.id')
                         ->where('transaccion.id',$id)
                         ->get();
    }
}
