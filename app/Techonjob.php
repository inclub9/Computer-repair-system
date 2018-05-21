<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Techonjob extends Model
{

    protected $table = 'techonjobs';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];


    public function SystemUser()
    {
        return $this->hasOne('App\SystemUser','id','systemuser_id');
    }

    public function Job()
    {
        return $this->hasOne('App\Job','id');
    }




}