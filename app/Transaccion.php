<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'transaccion';
    protected $fillable = ['idcliente','idtipo','fecha','hora','monto','interes','idestado'];
    protected $hidden = ['remember_token','idcliente','idtipo','idestado'];
    protected $guarded = [];
    // public $timestamps = false;
    /**
     * Propiedad que calcula el total
     * @return [type] [description]
     */
    public function getTotalAttribute()
    {
        $incremento =$this->monto*($this->interes/100);

        return $this->monto+$incremento;
    }
    /**
     * Relacion con la tabla transaccion detalle
     * @return [type] [description]
     */
    public function transacciondetalle()
    {
        return $this->hasMany('App\TransaccionDetalle','idtransaccion','id');
    }
    #####################################################################
	public function scopegetTransaccion($cadenaSQL,$id){
		return $cadenaSQL->select(
                                'transaccion.*',
                                'cliente.nombres',
                                'catalogo.nombre as estado'
                                )
                            ->join('cliente', 'cliente.id', '=', 'transaccion.idcliente')
                            ->join('catalogo', 'catalogo.id', '=', 'transaccion.idestado')
                            ->where('idtipo',$id)
                            ->orderBy('id','desc')->get();
	}
    /**
     * Trae las cuotas de un prestamo
     * @param  string $cadenaSQL consulta
     * @param  idtipo $id        tipo de transaccion
     * @return string            lista las cuotas
     */
    public function scopegetCuotas($cadenaSQL,$idtipo,$id){
        return $cadenaSQL->select(
                                'transaccion.*',
                                'cliente.nombres',
                                'catalogo.nombre as estado',
                                'cliente.foto'
                                )
                            ->join('cliente', 'cliente.id', '=', 'transaccion.idcliente')
                            ->join('catalogo', 'catalogo.id', '=', 'transaccion.idestado')
                            ->where('idtipo',$idtipo)
                            ->where('transaccion.id',$id)
                            ->with('transacciondetalle')
                            ->get();
    }
}
