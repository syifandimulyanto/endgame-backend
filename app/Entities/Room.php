<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model 
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'rooms';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'description'];

    public $timestamps = true;
    public $incrementing = false;

}