<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [ 'curent' ,'spent', 'client_id'];

       public function client(){

         return $this->belongsTo(Client::class);
     }

}
  