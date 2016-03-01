<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    protected $table = 'maestro';
    protected $fillable = ['nombre'];
    protected $hidden = ['remember_token'];
    // public $timestamps = false;
    #####################################################################
}
