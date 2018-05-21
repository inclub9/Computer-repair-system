<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Activity extends Model
{

    use LogsActivity;
    protected $table = 'activity_log';
    protected $fillable = ['name', 'text'];

    protected static $logAttributes = ['name', 'text'];
    public function SystemUser()
    {
        return $this->hasOne('App\SystemUser','id','causer_id');
    }

}