<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satisfaction extends Model 
{

    protected $table = 'satisfactions';
    public $timestamps = true;

    public function Job()
    {
        return $this->hasOne('App\Job');
    }

}