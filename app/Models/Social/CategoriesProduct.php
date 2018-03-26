<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;

class CategoriesProduct extends Model
{
    protected $connection = 'social';
    protected $table = 'category_product';
    public $timestamps = false;
}
