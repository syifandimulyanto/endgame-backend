<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecturer extends Model 
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'lecturers';
    protected $dates = ['deleted_at'];
    protected $fillable = ['nidn', 'nip', 'address', 'gender'];

    public $timestamps = true;
    public $incrementing = false;

    public function user()
    {
        return $this->hasOne('App\Entities\User', 'parent_id');
    }
}