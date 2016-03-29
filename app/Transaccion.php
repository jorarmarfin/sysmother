<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'transaccion';
    protected $fillable = ['fecha','hora','monto','interes'];
    protected $hidden = ['remember_token'];
    protected $guarded = ['idcliente','idtipo', 'total','idestado'];
    // public $timestamps = false;
    #####################################################################
	public function scopegetPrestamos($cadenaSQL,$id){
		return $cadenaSQL->select(
                                'transaccion.id',
                                'cliente.nombres',
                                'transaccion.fecha',
                                'transaccion.hora',
                                'transaccion.monto',
                                'transaccion.interes',
                                'transaccion.total',
                                'catalogo.nombre as estado'
                                )
                            ->join('cliente', 'cliente.id', '=', 'transaccion.idcliente')
                            ->join('catalogo', 'catalogo.id', '=', 'transaccion.idestado')
                            ->where('idtipo',$id)
                            ->orderBy('id','desc')->get();
	}
}
