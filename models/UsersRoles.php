<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class UsersRoles extends Eloquent {

	public function role()
    {
        return $this->belongsTo('role');
    }


}