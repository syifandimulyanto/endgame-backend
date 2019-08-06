<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    const BLAST = 'blast';

    use SoftDeletes;
    use Uuids;

    protected $table = 'notifications';
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'slug', 'description', 'type', 'user_id'];

    public $timestamps = true;
    public $incrementing = false;

}