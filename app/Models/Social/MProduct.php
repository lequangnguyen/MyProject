<?php

namespace App\Models\Social;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class MProduct extends Model
{
    protected $connection = 'social_mongodb';
    protected $collection = 'iProduct';
    /**
     * {@inheritdoc}
     */
    const CREATED_AT = 'createdAt';

    /**
     * {@inheritdoc}
     */
    const UPDATED_AT = 'updatedAt';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['time_user_update', 'ignore_date'];

    public function getVoteAverageStarAttribute($value)
    {
        $base = $this->attributes['vote_average'] * 10;
        $fullStarCount = floor($base / 10);
        $halfStarCount = 0;

        if (($base % 10) >= 5) {
            $halfStarCount = 1;
        }

        $emptyStarCount = 5 - $fullStarCount - $halfStarCount;

        return [
            'full' => $fullStarCount,
            'half' => $halfStarCount,
            'empty' => $emptyStarCount,
        ];
    }

    public function data()
    {
        return $this->hasOne(Product::class, 'gtin_code', 'gtin_code');
    }
}
