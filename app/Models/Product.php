<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the categories record associated with the product.
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Get the categories record associated with the product.
     */
    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    /**
     * Get the options record associated with the product.
     */
    public function options(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'options_products');
    }

    /**
     * Get the price record associated with the product.
     */
    public function variations(): HasMany
    {
        return $this->hasMany(Variation::class)->orderBy('price', 'asc');
    }

    /**
     * Get the price record associated with the product.
     */
    public function expert(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ExpertProduct::class, 'product_id', 'expert_id');
    }

    public function scopeByCategory($query, $category)
    {
        if (!is_null($category)) {
            return $query->whereHas('categories', function ($query) use ($category) {
                $query->where('category_id', $category);
            });
        }

        return $query;
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeIsFeatured($query)
    {
        return $query->where('featured', 1);
    }

    public function scopeFromParentCategory($query, $category)
    {
        if (!is_null($category)) {
            return $query->whereHas('categories', function ($query) use ($category) {
                $query->where('parent_id', $category)->orderBy('sort_order', 'asc');
            });
        }

        return $query;
    }

    public function scopePrice($query, $price)
    {
        if (!is_null($price)) {
            return $query->where('price', $price);
        }

        return $query;
    }

    public function scopeName($query, $name)
    {
        if (!is_null($name)) {
            return $query->where('name', 'like', '%' . $name . '%');
        }

        return $query;
    }

    public function getCastAttribute(): ?string
    {
        $cast = null;
        if ($this->weight || $this->amount) {
            if ($this->weight && $this->amount) {
                $cast = $this->weight . ' гр./' . $this->amount . ' шт';
            } elseif (!$this->weight && $this->amount) {
                $cast = $this->amount . ' шт';
            } elseif ($this->weight && !$this->amount) {
                $cast = $this->weight . ' гр.';
            }
        }
        return $cast;
    }
}
