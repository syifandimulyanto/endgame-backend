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
    protected $fillable = ['title', 'slug', 'description', 'image', 'type', 'user_id'];
    protected $appends = ['url'];

    public $timestamps = true;
    public $incrementing = false;

    public function getUrlAttribute()
    {
        return ($this->image ? url($this->image) : '');
    }

}