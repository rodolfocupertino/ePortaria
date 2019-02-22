<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class VisitantesVisita extends Eloquent {

	public function visitante()
    {
        return $this->belongsTo('Visitante');
    }


}