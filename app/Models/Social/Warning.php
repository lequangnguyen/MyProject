<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    protected $connection = 'social';

    protected $table = 'warning';

    protected $fillable = [
        'gtin_code', 'gln_code', 'message_id',

    ];

    public $timestamps = false;

    public function product()
    {
        return $this->hasOne(Product::class, 'gtin_code', 'gtin_code');
    }
}
