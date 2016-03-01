<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table = 'detalle';
    protected $fillable = ['idmaestro','descripcion'];
    protected $hidden = ['remember_token'];
    // public $timestamps = false;
    #####################################################################
}
