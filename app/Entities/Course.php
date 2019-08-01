<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Course extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    use Uuids;

    protected $table = 'courses';
    public $timestamps = true;
    public $incrementing = false;

    protected $dates = ['deleted_at'];
    protected $fillable = ['program_study_id', 'code', 'name', 'sks', 'semester', 'curriculum', 'status'];


    public function hasProgramStudy()
    {
        return $this->belongsTo('ProgramStudy');
    }

}