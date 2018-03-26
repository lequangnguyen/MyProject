<?php

namespace App\Models\Event;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class MEvent extends Model
{
    //use SoftDeletes;

    const DELETED_AT = 'deleteTime';

    protected $connection = 'mongodb_event';
    protected $collection = 'events';
    protected $guarded = [];
    protected $dates = ['startTime', 'endTime', 'deleteTime'];
    public $timestamps = false;

    public function gifts()
    {
        return $this->hasMany(MGift::class, 'eventId', '_id');
    }
}
