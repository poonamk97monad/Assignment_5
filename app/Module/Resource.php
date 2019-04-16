<?php

namespace App\Module;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'title','slug', 'description', 'file_upload', 'store_file'
    ];

    public function Collection()
    {
        return $this->belongsToMany(Collection::class);
    }
}
