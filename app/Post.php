<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	use SoftDeletes;
	
    protected $fillable = [ 
    	    'title',
            'name',
            'slug' ,
            'meta_description',
            'content',
            'image',
            'category_id',
            'published_at'];
}
