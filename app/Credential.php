<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    protected $fillable = [ 'name' ,'value', 'client_id'];

     public function client(){

         return $this->belongsTo(Client::class);
     }
}
