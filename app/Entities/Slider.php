<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'sliders';
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'image', 'description'];
    protected $appends = ['url'];

    public $timestamps = true;
    public $incrementing = false;

    public function getUrlAttribute()
    {
        return ($this->image ? url($this->image) : '');
    }

}