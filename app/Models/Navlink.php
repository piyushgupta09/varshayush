<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Navlink extends Model
{
    public function setNameAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function child()
    {
        return $this->hasMany(Navlink::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Navlink::class, 'parent_id', 'id');
    }

    public function hasParent() {
        return $this->parent !== null;
    }
}
