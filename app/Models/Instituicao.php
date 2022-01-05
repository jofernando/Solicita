<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    //
    protected $fillable = ['nome'];



    public function administrador(){

        return $this->belongsTo('App\Models\Administrador');

    }

    public function unidade(){

        return $this->hasMany('App\Models\Unidade');
    }


}
