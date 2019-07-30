<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentClass extends Model
{

    protected $table = 'classes';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}