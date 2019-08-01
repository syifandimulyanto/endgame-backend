<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentSchedule extends Model 
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'student_schedules';
    public $timestamps = true;
    public $incrementing = false;

    protected $dates = ['deleted_at'];
    protected $fillable = ['student_id', 'schedule_id'];

    public function student()
    {
        return $this->belongsTo('App\Entities\Student');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Entities\Schedule');
    }
}