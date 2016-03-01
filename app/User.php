<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','idrole'];
    /**
     * Para que la clave ingrese cifrada
     * @param [type] $value [description]
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password']= bcrypt($value);
        }
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    #--------------------------------------------------------------------
    public function scopeLista($cadenaSQL){
        return $cadenaSQL->select('users.id','name','email','password','catalogo.nombre as rol')
                         ->join('catalogo','users.idrole','=','catalogo.id')
                         ->orderby('users.id');
    }
}
