<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model 
{

    protected $table = 'schedules';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function hasLecture()
    {
        return $this->belongsTo('Lecturer');
    }

    public function hasCourse()
    {
        return $this->belongsTo('Course');
    }

    public function hasClass()
    {
        return $this->belongsTo('Class');
    }

    public function hasRoom()
    {
        return $this->belongsTo('Room');
    }

}