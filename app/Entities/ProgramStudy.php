<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramStudy extends Model 
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'program_studies';
    protected $dates = ['deleted_at'];
    protected $fillable = ['code', 'name'];

    public $timestamps = true;
    public $incrementing = false;

}