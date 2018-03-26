<?php

namespace App\Models\Social;

use Jenssegers\Mongodb\Eloquent\Model;

class MNotification extends Model
{
    protected $connection = 'social_mongodb';
    protected $collection = 'iNotifications';
    /**
     * {@inheritdoc}
     */
    const CREATED_AT = 'createdAt';

    /**
     * {@inheritdoc}
     */
    const UPDATED_AT = 'updatedAt';
}
