<?php

namespace App\Models\Social;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class MGroupType extends Model
{
    protected $connection = 'social_mongodb';
    protected $collection = 'iGroupType';

    /**
     * {@inheritdoc}
     */
    const CREATED_AT = 'createdAt';

    /**
     * {@inheritdoc}
     */
    const UPDATED_AT = 'updatedAt';

    public $timestamps = false;

    protected $guarded = [];
}
