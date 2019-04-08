<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = "post";

    public $fillable = [
    	'title', 'body'
   	];

   	protected $mappingProperties = [
   		'title' => [
   			'type' => 'string',
   			'analyzer' => 'standard'
   		],
   		'body' => [
   			'type' => 'string',
   			'analyzer' => 'standard'
   		],
   	];
}
