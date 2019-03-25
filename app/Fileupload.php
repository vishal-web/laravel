<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fileupload extends Model
{
    protected $table = "fileupload";

    protected $fillable = [
    	'filename' ,'details'
    ];

    public $timestamps = false;
}
