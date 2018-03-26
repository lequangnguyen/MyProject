<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'social';

    protected $table = 'category';
    /**
     * {@inheritdoc}
     */
    const CREATED_AT = 'createdAt';

    /**
     * {@inheritdoc}
     */
    const UPDATED_AT = 'updatedAt';
}
