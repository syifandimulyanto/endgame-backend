<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentScheduleChange extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'student_schedule_changes';
    protected $dates = ['deleted_at'];
    protected $fillable = ['schedule_id','room_id', 'date', 'start_time', 'end_time'];
    public $timestamps = true;
    public $incrementing = false;

    public function schedule()
    {
        return $this->belongsTo('App\Entities\Schedule');
    }

    public function room()
    {
        return $this->belongsTo('App\Entities\Room');
    }

}