<?php

namespace App\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'menus';
    protected $dates = ['deleted_at'];
    protected $fillable = ['parent_id', 'name', 'action', 'sort', 'route', 'show_in_menu'];

    public $timestamps = true;
    public $incrementing = false;

    public function children()
    {
        return $this->hasMany('App\Entities\Menu','parent_id')->with('children');
    }
}