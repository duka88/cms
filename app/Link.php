<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
       protected $fillable = [ 'name', 'client_id', 'type_id'];

       public function client(){

         return $this->belongsTo(Client::class);
     }

       public function type(){

         return $this->belongsTo(Type::class);
     }
}
