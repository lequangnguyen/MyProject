<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class DistributorProduct extends Model
{
    protected $connection = 'social';

    protected $table = 'distributor_product';

    protected $fillable = [
        'product_id', 'distributor_id', 'is_monopoly'

    ];

    public $timestamps = false;
}
