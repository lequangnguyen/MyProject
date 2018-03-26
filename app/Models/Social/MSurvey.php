<?php

namespace App\Models\Social;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class MSurvey extends Model
{
    protected $connection = 'social_mongodb';
    protected $collection = 'iSurvey';
    public $timestamps = false;
    protected $guarded = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
        'put_first' => 'integer',
    ];
}
