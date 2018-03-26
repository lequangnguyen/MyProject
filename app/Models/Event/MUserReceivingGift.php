<?php

namespace App\Models\Event;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class MUserReceivingGift extends Model
{
    //use SoftDeletes;

    protected $connection = 'mongodb_event';
    protected $collection = 'userReceivingGift';
    protected $guarded = [];
    public $timestamps = false;

    public function gift()
    {
        return $this->belongsTo(MGift::class, 'giftId', '_id');
    }
}
