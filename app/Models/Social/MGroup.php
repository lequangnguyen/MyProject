<?php

namespace App\Models\Social;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class MGroup extends Model
{
    protected $connection = 'social_mongodb';
    protected $collection = 'iGroup';

    /**
     * {@inheritdoc}
     */
    const CREATED_AT = 'createdAt';

    /**
     * {@inheritdoc}
     */
    const UPDATED_AT = 'updatedAt';

    public function groupType()
    {
        return $this->belongsTo(MGroupType::class, 'type', 'type');
    }
}
