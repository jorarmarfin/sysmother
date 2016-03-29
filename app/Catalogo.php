<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $table = 'catalogo';
    protected $fillable = ['idtable', 'iditem', 'codigo','nombre','descripcion','valor','activo'];
    protected $hidden = ['remember_token'];
    // public $timestamps = false;
    /**
     * Referncia a tablas
     * @return [type] [description]
     */
    public function transaccion()
    {
        return $this->hasOne('App\Transaccion', 'idtipo', 'id');
    }
    #####################################################################
	public function Maestro($NameTable){
		$data=$this->select('iditem')
				   ->where('idtable',0)
			       ->where('nombre',"$NameTable")->first();
		return $data->iditem;
	}
	#--------------------------------------------------------------------
	public function scopeCombo($cadenaSQL,$NameTable){
		$idtable=$this->Maestro($NameTable);
		return $cadenaSQL->where('idtable',$idtable)
						 ->where('activo',1)->orderBy('id');
	}
	#--------------------------------------------------------------------
	public function scopeIdCatalogo($cadenaSQL,$NameTable,$NameSubTable){
		$idtable=$this->Maestro($NameTable);
		return $cadenaSQL->where('idtable',$idtable)
						 ->where('nombre',$NameSubTable)
						 ->where('activo',1)->lists('id')[0];
	}

}
