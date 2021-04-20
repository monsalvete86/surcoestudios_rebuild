<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    protected $table = 'resultados';
    protected $fillable = [
        'id_alumno'
        , 'id_modulo'
        , 'pregutas'
        , 'respondidas'
        , 'resultado'
        , 'fecha_realiz'
        , 'id_inscripcion'
    ];
}
