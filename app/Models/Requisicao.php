<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Requisicao extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //
    protected $fillable = ['aluno_id','data_pedido','hora_pedido'];


    public function perfil(){
        return $this->belongsTo('App\Models\Perfil');
    }

    public function servidor(){
        return $this->belongsTo('App\Models\Servidor');
    }

    public function requisicao_documento(){
        return $this->hasMany('App\Models\Requisicao_documento');
    }

}
