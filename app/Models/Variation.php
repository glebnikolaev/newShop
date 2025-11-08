<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Variation extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the options record associated with the product.
     */
    public function option(): Variation|HasOne
    {
        return $this->hasOne(Option::class, 'id', 'option_id');
    }

    public function getOptionNameAttribute()
    {
        return $this->option()->name;
    }


}
