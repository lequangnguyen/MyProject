<?php

namespace App\Models\Enterprise;

use Illuminate\Database\Eloquent\Model;
use App\Models\Social\MFeed;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use MongoDB\BSON\ObjectID;

class Post extends Model
{
    use HybridRelations;

    protected $table = 'posts';

    protected $fillable = [
        'title', 'description', 'content',
        'image', 'source', 'tag',

    ];

    public function feed()
    {
        return $this->hasOne(MFeed::class, '_id', 'icheck_id');
    }
}
