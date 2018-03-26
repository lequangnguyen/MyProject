<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $connection = 'social';

    protected $table = 'country';
}
