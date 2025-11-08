<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OptionParameter extends Model
{
    protected $table = 'options_parameters';

    public function variation(): HasOne
    {
        return $this->hasOne(Variation::class);
    }
}
