<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevTime extends Model
{
    protected $fillable = [ 'started' ,'time-frame', 'finished','client_id'];

     public function client(){

         return $this->belongsTo(Client::class);
     }

}
