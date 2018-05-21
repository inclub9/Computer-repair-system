<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model 
{

    protected $table = 'claims';
    public $timestamps = true;
    protected $fillable = ['job_id','status','sn','partner'];
    public function Remark()
    {
        return $this->hasMany('Remark', 'claim_id');
    }

    public function Job()
    {
        return $this->hasOne('App\Job');
    }

}