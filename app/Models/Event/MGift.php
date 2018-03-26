<?php

namespace App\Models\Event;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use App\Models\Social\MAccount;

class MGift extends Model
{
    //use SoftDeletes;

    const DELETED_AT = 'deleteTime';

    protected $connection = 'mongodb_event';
    protected $collection = 'gifts';
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ['deleteTime'];

    public function event()
    {
        return $this->belongsTo(MEvent::class, 'eventId', '_id');
    }

    public function userReceive()
    {
        return $this->hasOne(MUserReceivingGift::class, 'giftId', '_id');
    }

    public function receiver()
    {
        return $this->hasOne(MAccount::class, 'icheck_id', 'receiverId');
    }
}
