<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model 
{

    protected $table = 'departments';
    public $timestamps = true;
    protected $fillable = ['name'];
    public function Tech()
    {
        return $this->hasMany('Systemuser', 'id');
    }

}