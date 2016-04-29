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
	                       ->join('producto','producto.id','=','venta_detalle.idproducto')
	                       ->join('transaccion','transaccion.id','=','venta_detalle.idtransaccion')
	                       ->join('cliente','cliente.id','=','transaccion.idcliente')
	                       ->where('idtransaccion',$id)
	                       ->orderBy('id')
	                       ->get();
    }

    public function scopegetTotalVenta($cadenaSQL,$id)
    {
    	return $cadenaSQL->select(
	                            DB::raw('venta_detalle.cantidad*producto.precio_venta ')
	                            )
	                       ->join('producto','producto.id','=','venta_detalle.idproducto')
	                       ->where('idtransaccion',$id)
	                       ->orderBy('id')
	                       ->get();
    }

}
