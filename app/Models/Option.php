<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Option extends Model
{
    protected $fillable = [
        'name',
    ];

    public function parameters(): HasMany
    {
        return $this->hasMany(OptionParameter::class)->orderBy('sort_order');
    }

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'options_products');
    }


}
