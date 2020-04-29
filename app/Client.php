<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
      protected $fillable = [ 'name' ,'company', 'email', 'industry_id' ];

    public function services(){

         return $this->belongsToMany(Service::class);
     }

    public function links(){

         return $this->hasMany(Link::class);
     }

    public function budget(){

         return $this->hasOne(Budget::class);
     }

    public function industry(){

         return $this->belongsTo(Industry::class);
     }

    public function dev_time(){
        return $this->hasOne(DevTime::class);
    } 

    public function credentials(){

         return $this->hasMany(Credential::class);
     }
}