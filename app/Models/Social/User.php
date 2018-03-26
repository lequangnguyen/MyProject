<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $connection = 'social';

    protected $table = 'user';
}
