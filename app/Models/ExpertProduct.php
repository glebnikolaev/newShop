<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpertProduct extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the price record associated with the product.
     */
    public function expert()
    {
        return $this->hasOne(ExpertProduct::class, 'product_id', 'expert_id');
    }
}
