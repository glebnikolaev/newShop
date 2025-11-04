<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];
    /**
     * Get the products for this category.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id')->orderBy('sort_order', 'asc');
    }

    public function child()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function parent()
    {
        return $this->hasOne(Category::class,'parent_id','id');
    }

    public function scopeIsActive($query)
    {

        return $query->where('status', 1);
    }

}
