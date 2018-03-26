<?php

namespace App\Models\Social;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class MProductRelated extends Model
{
    protected $connection = 'social_mongodb';
    protected $collection = 'iProductRelated';

    //public $timestamps = false;
    /**
     * Get all of the tags for the post.
     */
    protected $fillable = [
        'gtin_code', 'internal_code'

    ];
}
