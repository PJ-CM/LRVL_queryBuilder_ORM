<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dato extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'contrasenia', 'edad', 'saldo', 'comentarios', 'register_at', 'activo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
