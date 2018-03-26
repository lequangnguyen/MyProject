<?php

namespace App\Models\Social;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class MComment extends Model
{
    protected $connection = 'social_mongodb';
    protected $collection = 'iComment';
    /**
     * {@inheritdoc}
     */
    const CREATED_AT = 'createdAt';

    /**
     * {@inheritdoc}
     */
    const UPDATED_AT = 'updatedAt';

    public function childs()
    {
        return $this->hasMany(MComment::class, 'parent', 'objectId');
    }

    public function getObjectIdAttribute($value)
    {
        return $this->attributes['_id'];
    }
}
