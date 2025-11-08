<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    protected $guarded = ['id'];
    /**
     * Get the products for this category.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id')->orderBy('sort_order', 'asc');
    }

    public function child(): HasMany|Category
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function parent(): HasOne|Category
    {
        return $this->hasOne(Category::class,'parent_id','id');
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

}
