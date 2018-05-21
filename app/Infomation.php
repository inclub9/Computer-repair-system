<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infomation extends Model
{
    protected $table = 'infomations';
    public $timestamps = true;
    protected $fillable = ['news', 'url'];

}
