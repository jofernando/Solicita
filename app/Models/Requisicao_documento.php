<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Requisicao_documento extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['anotacoes','status','status_data','detalhes'];

    public function requisicao(){
        return $this->belongsTo('App\Models\Requisicao', 'requisicao_id');
    }
    public function documento(){
        return $this->hasMany('App\Models\Documento');
    }
    public function aluno(){
        return $this->belongsTo('App\Models\Aluno','aluno_id');
    }
}
