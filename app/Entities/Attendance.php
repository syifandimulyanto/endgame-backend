<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model 
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'attendances';
    public $timestamps = true;
    public $incrementing = false;

    protected $dates = ['deleted_at'];
    protected $fillable = ['student_schedule_id', 'date'];

    public function studentSchedule()
    {
        return $this->belongsTo('App\Entities\StudentSchedule', 'student_schedule_id');
    }

}