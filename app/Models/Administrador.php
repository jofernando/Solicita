<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    //
    protected $fillable = ['matricula'];


    public function instituicao(){

        return $this->hasOne('App\Models\Instituicao');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
