<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = ['id'];

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }
}
