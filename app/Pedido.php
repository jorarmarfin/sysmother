<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedido';
    protected $fillable = ['id', 'idtransaccion', 'idproducto','cantidad','total','fecha','hora'];
    protected $hidden = ['remember_token'];
    // public $timestamps = false;
    #####################################################################
}
