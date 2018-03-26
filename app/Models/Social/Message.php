<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $connection = 'social';

    protected $table = 'message';

    protected $fillable = [
        'short_msg', 'full_msg', 'title',

    ];

    public $timestamps = false;
}
