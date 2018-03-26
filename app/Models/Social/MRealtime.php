<?php

namespace App\Models\Social;

use Jenssegers\Mongodb\Eloquent\Model;

class MRealtime extends Model
{
    protected $connection = 'social_mongodb';
    protected $collection = 'iRealtime';
    /**
     * {@inheritdoc}
     */
    const CREATED_AT = 'createdAt';

    /**
     * {@inheritdoc}
     */
    const UPDATED_AT = 'updatedAt';
}
