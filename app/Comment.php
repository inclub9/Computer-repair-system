<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model 
{

    protected $table = 'comments';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['job_id','status_id','comment'];
    public function Job()
    {
        return $this->hasOne('App\Job', 'id','job_id');
    }

    public function SystemUser()
    {
        return $this->belongsTo('App\SystemUser','systemuser_id','id');
    }

}