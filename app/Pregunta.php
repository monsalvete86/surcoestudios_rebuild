<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'preguntas';

    protected $fillable = [
        'pregunta'
        , 'id_modulo'
        , 'tipo'
        , 'a', 'b', 'c', 'd', 'e', 'f'
        , 'respuesta'
    ];
}
