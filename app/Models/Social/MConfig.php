<?php

namespace App\Models\Social;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class MConfig extends Model
{
    protected $connection = 'social_mongodb';
    protected $collection = 'iConfigurations';

    public $timestamps = false;
}
