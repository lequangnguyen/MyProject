<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $connection = 'social';

    protected $table = 'account';
}
