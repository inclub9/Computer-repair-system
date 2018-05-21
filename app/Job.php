<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Job extends Model
{

    protected $table = 'jobs';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'type_id', 'problem', 'telnum', 'depart_id', 'techonjob_id'];

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Type()
    {
        return $this->belongsTo('App\Type');
    }

    public function Department()
    {
        return $this->hasOne('App\Department', 'id');
    }


    public function Claim()
    {
        return $this->hasMany('App\Claim', 'job_id');
    }

    public function Techonjob()
    {
        return $this->hasMany('App\Techonjob');
    }



    public function Comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function Satisfaction()
    {
        return $this->hasone('App\Satisfaction', 'job_id');
    }


}