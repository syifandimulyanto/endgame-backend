<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model 
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'students';
    protected $dates = ['deleted_at'];
    protected $fillable = ['program_study_id', 'nrp', 'birth_date', 'birth_place', 'gender', 'religion'];

    public $timestamps = true;
    public $incrementing = false;


    public function hasProgramStudy()
    {
        return $this->belongsTo('ProgramStudy');
    }

    public function user()
    {
        return $this->hasOne('App\Entities\User', 'parent_id');
    }

}