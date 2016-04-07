<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class TransaccionDetalle extends Model
{
    protected $table = 'transaccion_detalle';
    protected $fillable = ['idtransaccion','entrada','salida','fecha','hora'];
    protected $hidden = ['remember_token'];
    // public $timestamps = false;
    #####################################################################
    public function scopeSumaPagada($cadenaSQL,$id)
    {
    	return $cadenaSQL->select(DB::raw('sum(entrada) as suma'))
                                    ->where('idtransaccion',$id)->get();
    }
}
