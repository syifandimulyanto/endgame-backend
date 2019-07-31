<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'classes';
    public $timestamps = true;
    public $incrementing = false;

    protected $dates = ['deleted_at'];
    protected $fillable = ['code', 'name'];

}