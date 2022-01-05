<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    //
    protected $fillable = ['tipo'];

    public function requisicao_documento(){
        return $this->belongsTo('App\Models\Requisicao_documento');
    }
}
