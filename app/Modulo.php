<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table = 'modulos';

    protected $fillable = [
        'modulo'
        , 'id_curso'
        , 'estado'
        , 'contenido'
        , 'video'
        , 'texto_prueba'
    ];
}
