<?php

namespace App\Models\Collaborator;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Enterprise\Collaborator;
use App\Models\Enterprise\User;

class ContributeProduct extends Model
{
    const STATUS_DISAPPROVED = 0;
    const STATUS_APPROVED = 1;
    const STATUS_PENDING_APPROVAL = 2;
    const STATUS_IN_PROGRESS = 3;
    const STATUS_ERROR = 4;
    const STATUS_AVAILABLE_CONTRIBUTE = 5;

    /**
     * {@inheritdoc}
     */
    const CREATED_AT = 'createdAt';

    /**
     * {@inheritdoc}
     */
    const UPDATED_AT = 'updatedAt';

    public static $statusTexts = [
        self::STATUS_DISAPPROVED => 'disapproved',
        self::STATUS_APPROVED => 'approved',
        self::STATUS_PENDING_APPROVAL => 'pending approval',
        self::STATUS_IN_PROGRESS => 'in progress',
        self::STATUS_ERROR => 'error',
        self::STATUS_AVAILABLE_CONTRIBUTE => 'available contribute',
    ];

    protected $connection = 'collaborator_mongodb';

    protected $table = 'contribute_products';

    protected $dates = ['contributedAt'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['gtin', 'status', 'price', 'approvedAt', 'note', 'approvedBy', 'amount', 'group'];

    public function contributor()
    {
        return $this->belongsTo(Collaborator::class, 'contributorId');
    }

    public function getStatusTextAttribute($value)
    {
        return static::$statusTexts[$this->attributes['status']];
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approvedBy');
    }
}
