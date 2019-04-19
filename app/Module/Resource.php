<?php

namespace App\Module;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'title','slug', 'description', 'file_upload', 'store_file'
    ];

    public function collection() {
        return $this->belongsToMany(Collection::class);
    }

    public function collections() {
        return $this->belongsToMany(Collection::class, 'collection_resources', 'resource_id', 'collection_id');
    }
}
