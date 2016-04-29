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
    * Calcula el total de lo vendido
    * @param  string $cadenaSQL consulta
    * @param  integer $id        id de la transaccion
    * @return data las ventas de la transaccion
    */
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
