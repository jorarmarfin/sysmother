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
}
