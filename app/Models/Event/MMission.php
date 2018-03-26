<?php

namespace App\Models\Event;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class MMission extends Model
{
    //use SoftDeletes;

    const DELETED_AT = 'deleteTime';

    protected $connection = 'mongodb_event';
    protected $collection = 'missions';
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ['deleteTime'];
}
