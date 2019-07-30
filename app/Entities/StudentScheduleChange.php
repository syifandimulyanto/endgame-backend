<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentScheduleChange extends Model 
{

    protected $table = 'student_schedule_changes';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function hasSchedule()
    {
        return $this->belongsTo('Schedule');
    }

    public function hasRoom()
    {
        return $this->belongsTo('Room');
    }

}