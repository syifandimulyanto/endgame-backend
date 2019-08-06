<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model 
{

    use SoftDeletes;
    use Uuids;

    protected $table = 'schedules';
    protected $dates = ['deleted_at'];
    protected $fillable = ['course_id', 'lecture_id', 'room_id', 'class_id', 'period', 'period_year', 'start_date', 'end_date', 'day', 'start_time', 'end_time'];
    public $timestamps = true;
    public $incrementing = false;

    public function studentSchedule()
    {
        return $this->hasMany('App\Entities\StudentSchedule', 'schedule_id');
    }

    public function lecture()
    {
        return $this->belongsTo('App\Entities\Lecturer');
    }

    public function course()
    {
        return $this->belongsTo('App\Entities\Course');
    }

    public function classes()
    {
        return $this->belongsTo('App\Entities\Classes', 'class_id');
    }

    public function room()
    {
        return $this->belongsTo('App\Entities\Room');
    }

}