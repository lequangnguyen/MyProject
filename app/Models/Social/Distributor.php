<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Distributor extends Model
{
    protected $connection = 'social';
    protected $table = 'distributor';

    /**
     * Get all of the tags for the post.
     */
    protected $fillable = [
        'name', 'address', 'country',
        'contact', 'other', 'status', 'site'

    ];
    /**
     * {@inheritdoc}
     */
    const CREATED_AT = 'createdAt';

    /**
     * {@inheritdoc}
     */
    const UPDATED_AT = 'updatedAt';

    public function country()
    {
        return $this->belongsTo(Country::class, 'country');
    }

    /**
     * Get all of the tags for the post.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'distributor_product', 'distributor_id', 'product_id');
    }

}
