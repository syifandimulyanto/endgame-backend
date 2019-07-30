<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model 
{

    protected $table = 'students';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function hasProgramStudy()
    {
        return $this->belongsTo('ProgramStudy');
    }

}