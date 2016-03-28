<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'transaccion';
    protected $fillable = ['idcliente','idtipo','fecha','hora','monto','interes','total','idestado'];
    protected $hidden = ['remember_token'];
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
                            ->orderBy('id')->get();
	}
}
