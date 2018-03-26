<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $connection = 'social';

    protected $table = 'currency';
}
