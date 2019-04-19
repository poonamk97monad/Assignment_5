<?php

namespace App\Module;

use Illuminate\Database\Eloquent\Model;
use App\Module\Resource;

class Collection extends Model
{
    protected $fillable = [
        'title', 'slug','description'
    ];

    public function resource()
    {
        return $this->belongsToMany(Resource::class);
    }

    public function resources()
    {
        return $this->belongsToMany(Resource::class, 'collection_resources', 'collection_id', 'resource_id');
    }
}
