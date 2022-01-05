<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
   //
   protected $fillable = ['matricula'];


   public function requisicao(){
      return $this->hasMany('App\Models\Requisicao');
   }

   public function unidade(){
      return $this->belongsTo('App\Models\Unidade');
   }

   public function user(){
      return $this->belongsTo('App\Models\User');
   }


}
