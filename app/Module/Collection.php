<?php

namespace App\Module;

use Laravel\Scout\Searchable;
use Elasticquent\ElasticquentTrait;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Model;


class Collection extends Model
{
//    use Searchable;
//    use ElasticquentTrait;

    protected $fillable = [
        'title', 'slug','description','modeltype'
    ];

//
//    /**
//     * Get the indexable data array for the model.
//     *
//     * @return array
//     **/
//    protected $mappingProperties =array(
//
//        'title' => [
//            'type' => 'string',
//            "analyzer" => "standard",
//        ],
//        'slug' => [
//            'type' => 'string',
//            "analyzer" => "standard",
//        ],
//        'description' => [
//            'type' => 'string',
//            "analyzer" => "standard",
//        ]
//    );

//
//    public function toSearchableArray() {
//        $array = $this->toArray();
//        return $array;
//    }

    /**
     * The accessors to append to the model's array form.
     * @var array
     */
    protected $appends = ['is_favortted'];
    /**
     * resources method for relationship
     */
    public function resources() {

        return $this->belongsToMany(Resource::class, 'collection_resources', 'collection_id', 'resource_id');
    }

    /**
     * The accessors to append to the model's array form.
     */
    public function getIsFavorttedAttribute() {
        return Redis::SISMEMBER('favorite:vuecollection', $this->getKey());
    }

    /**
     * The method for add key in redis
     */
    public function isFavortted() {
        return Redis::SISMEMBER('favorite:vuecollection', $this->getKey());
    }
}
