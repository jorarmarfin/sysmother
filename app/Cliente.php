<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $fillable = ['nombres','dni','telefono','celular','email','direccion','tienda','foto'];
    protected $hidden = ['remember_token'];
    // public $timestamps = false;
    /**
     * Referncia a tablas
     * @return [type] [description]
     */
    public function transaccion()
    {
        return $this->hasOne('App\Transaccion', 'id', 'idcliente');
    }
    #####################################################################
}
