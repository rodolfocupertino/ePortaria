<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {

	 protected $hidden = array('password');
	 
	// protected $fillable = ['title'];
	// public $timestamps = true;
	// public function role()
 //    {
 //        return $this->belongsTo('Roles');
 //    }


}