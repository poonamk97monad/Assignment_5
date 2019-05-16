<?php

namespace App\Module;


use Laravel\Scout\Searchable;
use Elasticquent\ElasticquentTrait;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
//   use Searchable;
     use ElasticquentTrait;

     protected $fillable = [
        'title','slug', 'description','modeltype'
     ];

        /**
         * Get the indexable data array for the model.
         *
         * @return array
         **/
      protected $mappingProperties =array(
          '     id' => [
                   'type' => 'integer',
//                   'index' => 'not_analyzed'
                ],
                'title' => [
                    'type' => 'text',
//                    "analyzer" => "standard",
                ],
                'title_sort' => [
                    'type' => 'long'
                ],
                'description_sort' => [
                'type' => 'long'
                ],
                'slug' => [
                    'type' => 'text',
//                    "analyzer" => "standard",
                ],
                'description' => [
                    'type' => 'text',
//                    "analyzer" => "standard"
                ]
      );

     public function toSearchableArray() {
         $array = $this->toArray();
         return $array;
     }

    /**
     * The accessors to append to the model's array form.
     * @var array
     */
    protected $appends = ['is_favortted'];

    /**
     * for many to many relationship
     */
    public function collections() {
        return $this->belongsToMany(Collection::class, 'collection_resources', 'resource_id', 'collection_id');
    }

    /**
     * The accessors to append to the model's array form.
     */
    public function getIsFavorttedAttribute() {
        return Redis::SISMEMBER('favorite:vueresource', $this->getKey());
    }

    /**
     * The method for add key in redis
     */
    public function isFavortted() {
        return Redis::SISMEMBER('favorite:vueresource', $this->getKey());
    }
}
