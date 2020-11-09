<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, SoftDeletes;

    protected $table = 'Usuarios';

    protected $with = ['Rol'];

    protected $hidden = [
        'password',
    ];

    public function rol()
    {
        return $this->belongsTo('App\Rol');
    }

    public function pedido()
    {
        return $this->hasMany('App\Pedido');
    }
}
