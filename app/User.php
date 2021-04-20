<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable

{

    use Notifiable, HasApiTokens;

    /*
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $fillable = [
        'name', 'email', 'password', 'bio', 'photo','type','apellido','tipo_id', 'documento', 'telefonos', 'lugar_expe' , 'empresa', 'estado', 'instructor', 'titulo', 'info_tutor'
    ];


    /**

     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

}

