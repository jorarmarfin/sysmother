<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $fillable = ['nombres','dni','telefono','celular','email','direccion','tienda','foto'];
    protected $hidden = ['remember_token'];
    // public $timestamps = false;
    #####################################################################
}
