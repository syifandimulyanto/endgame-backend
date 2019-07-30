<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentSchedule extends Model 
{

    protected $table = 'student_schedules';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function hasStudent()
    {
        return $this->belongsTo('Student');
    }

    public function hasSchedule()
    {
        return $this->belongsTo('Schedule');
    }

}