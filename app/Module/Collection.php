<?php

namespace App\Module;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'title', 'slug','description'
    ];

    public function resource()
    {
        return $this->belongsToMany(Resource::class);
    }
}
