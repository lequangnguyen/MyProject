<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AgencyProduct extends Model
{
    protected $connection = 'social';

    protected $table = 'agency_product';

    protected $fillable = [
        'product_id', 'agency_id', 'price', 'price_off', 'currency_code'

    ];

    public $timestamps = false;
}
