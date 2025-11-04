<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the options record associated with the product.
     */
    public function option()
    {
        return $this->hasOne(Option::class, 'id', 'option_id');
    }

    /**
     * Get the price record associated with the product.
     */
    public function expert()
    {
        return $this->hasOne(ExpertProduct::class, 'product_id', 'expert_id');
    }

    public function getOptionNameAttribute()
    {
        return $this->option()->name;
    }


}
