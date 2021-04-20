<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';

    protected $fillable = [
        'nombre'
        , 'categoria'
        , 'tutor'
        , 'duracion'
        , 'tipo_duracion'
        , 'img'
        , 'valor'
        , 'descripcion'
        , 'tipo'
        , 'validez'
        , 'tipo_validez'
    ];
}
