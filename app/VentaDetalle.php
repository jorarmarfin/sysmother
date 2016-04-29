<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class VentaDetalle extends Model
{
    protected $table = 'venta_detalle';
    protected $fillable = ['idtransaccion','idproducto','cantidad','fecha','hora'];
    protected $hidden = ['remember_token'];
    /**
     * Obtiene el detalle de las ventas
     * @param  string $cadenaSQL consulta
     * @param  integer $id        id de la transaccion
     * @return data            la data que se busca
     */
    public function scopegetVentaDetalle($cadenaSQL,$id)
    {
    	return $cadenaSQL->select(
	                            'venta_detalle.id',
	                            'cliente.nombres as cliente',
	                            'producto.nombre as producto',
	                            'venta_detalle.cantidad',
	                            'producto.precio_venta as precio',
	                            'venta_detalle.fecha',
	                            'venta_detalle.hora'
	                            )
	                       ->Join('producto','producto.id','=','venta_detalle.idproducto')
	                       ->Join('transaccion','transaccion.id','=','venta_detalle.idtransaccion')
	                       ->Join('cliente','cliente.id','=','transaccion.idcliente')
	                       ->where('idtransaccion',$id)
	                       ->orderBy('venta_detalle.id')
	                       ->get();
    }

    public function scopegetTotalVenta($cadenaSQL,$id)
    {
    	return $cadenaSQL->select(
	                            DB::raw('sum(cantidad*precio_venta) as total ')
	                            )
	                       ->join('producto','producto.id','=','venta_detalle.idproducto')
	                       ->where('idtransaccion',$id)
	                       ->orderBy('venta_detalle.id')
	                       ->get();
    }

}
