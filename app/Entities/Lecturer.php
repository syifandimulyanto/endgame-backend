<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecturer extends Model 
{

    protected $table = 'lecturers';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}