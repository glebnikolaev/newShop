<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'name',
    ];

    public function parameters(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OptionParameter::class)->orderBy('sort_order');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'options_products');
    }


}
