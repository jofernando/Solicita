<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use SoftDeletes;

class Perfil extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['default','situacao', 'valor', 'aluno_id', 'unidade_id', 'curso_id'];
    protected $dates = ['deleted_at'];

    public function requisicao(){
        return $this->hasMany('App\Models\Requisicao');
    }

    public function aluno(){
        return $this->belongsTo('App\Models\Aluno');
    }

    public function curso(){
        return $this->belongsTo('App\Models\Curso');
    }

}
