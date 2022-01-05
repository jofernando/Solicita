<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    //
    protected $fillable = ['nome'];


    public function perfil(){
        return $this->hasMany('App\Models\Perfil');
    }

    public function unidade(){
        return $this->belongsTo('App\Models\Unidade');
    }
}
