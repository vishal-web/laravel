<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
    	'user_id',
    	'product_id',
    	'firstname',
    	'lastname',
    	'email',
    	'contact',
    	'shipping_city',
		'shipping_state',
		'shipping_address1', s
    	'shipping_address2',
    	'shipping_landmark',
    	'status'
    ];

    function orders() {
        return $this->belongsToMany('App\User');
    }
}