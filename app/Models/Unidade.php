<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    //
    protected $fillable = ['nome'];


    public function instituicao(){
        return $this->belongsTo('App\Models\Instituicao');
    }

    public function servidor(){
        return $this->hasMany('App\Models\Servidor');
    }

    public function curso(){
        return $this->hasMany('App\Models\Curso');
    }

}
