<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionParameter extends Model
{
    protected $table = 'options_parameters';

    public function variation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Variation::class);
    }
}
