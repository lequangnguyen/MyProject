<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use App\Models\Enterprise\MICheckReport;

class Product extends Model
{
    use HybridRelations;

    protected $connection = 'social';
    protected $table = 'product';

    /**
     * {@inheritdoc}
     */
    const CREATED_AT = 'createdAt';

    /**
     * {@inheritdoc}
     */
    const UPDATED_AT = 'updatedAt';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_name', 'gtin_code', 'image_default', 'price_default', 'status', 'currency_default', 'internal_code', 'ctv_id', 'ctv_status'];

    /**
     * Get all of the tags for the post.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function mdata()
    {
        return $this->hasOne(MProduct::class, 'gtin_code', 'gtin_code');
    }

    public function ctv()
    {
        return $this->hasOne(User::class, 'id', 'ctv_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor');
    }

    public function vendor2()
    {
        return $this->belongsTo(Vendor::class, 'vendor');
    }

    /**
     * Get all of the tags for the post.
     */
    public function attributes()
    {
        return $this->belongsToMany(ProductAttr::class, 'product_info', 'product', 'attribute')->withPivot(['content']);
    }

    /**
     * Get all of the tags for the post.
     */
    public function reports()
    {
        return $this->hasMany(MICheckReport::class, 'target', 'gtin_code');
    }
}
