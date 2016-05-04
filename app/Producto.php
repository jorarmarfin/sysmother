<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $fillable = ['codigo','nombre','direccion','idcategoria','stock','precio_costo','ganancia','descuento','precio_venta','activo'];
    protected $hidden = ['remember_token'];
    // public $timestamps = false;
    /**
     * Propiedad que calcula el total
     * @return [type] [description]
     */
    public function getEstadoAttribute()
    {
        if ($this->activo==1) {
        	$estado='Activo';
        } else {
        	$estado='Inactivo';
        }
        return $estado;
    }
}
