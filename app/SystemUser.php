<?php

namespace App;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SystemUser extends Authenticatable
{
    use Notifiable;
    protected $table = 'systemusers';
    public $timestamps = true;
    protected $guarded ='admin';
    use SoftDeletes;
    protected $fillable = [
        'name', 'email', 'password','department_id'
    ];

    protected $dates = ['deleted_at'];

    public function Department()
    {
        return $this->hasOne('Department', 'id');
    }

    public function Techonjob()
    {
        return $this->hasMany('Techonjob', 'id');
    }
    public function SystemUserFindJob()
    {
        return $this->hasMany('Techonjob', 'systemuser_id');
    }

}