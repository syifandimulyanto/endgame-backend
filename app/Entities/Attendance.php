<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model 
{

    protected $table = 'attendances';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function hasStudentSchedule()
    {
        return $this->belongsTo('StudentSchedule');
    }

}