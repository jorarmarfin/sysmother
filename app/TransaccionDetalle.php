<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaccionDetalle extends Model
{
    protected $table = 'transaccion_detalle';
    protected $fillable = ['idtransaccion','entrada','salida','fecha','hora'];
    protected $hidden = ['remember_token'];
    // public $timestamps = false;
    #####################################################################
}
