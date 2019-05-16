<?php

namespace App\Http\Controllers;

use App\Module\Resource;
use App\Module\Collection;
use App\Helpers\CreateSlug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CollectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $arrObjCollections = Collection::latest();
        return view('collection.index', compact('arrObjCollections'));
    }
    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */

    public function getIndexData() {

        $arrObjCollections   = Collection::with('resources')->latest()->paginate(5);
        $arrObjResources     = Resource::all();

        return response()->json(["arrObjCollections" => $arrObjCollections,"arrObjResources" => $arrObjResources]);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $objCollectionRequest
     * @return \Illuminate\Http\Response
     */
    public function postStoreCollection(Request $objCollectionRequest) {
       $modeltype = 'collection';
        $arrFormData = array(
            'title'              =>   $objCollectionRequest->title,
            'slug'               =>   (new CreateSlug())->get($objCollectionRequest->title),
            'description'        =>   $objCollectionRequest->description,
            'modeltype'          => $modeltype,
        );
        $collection = Collection::create($arrFormData);

        return response()->json($collection);
    }

    /**
     * Show the form for delete the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCollection($id) {
        Collection::destroy($id);

        return response()->json("ok");
    }


    /**
     * Show the form for editing the specified Collection
     * @param  \Illuminate\Http\Request  $objCollectionUpdateRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdateCollection(Request $objCollectionUpdateRequest,$intCollectionId) {

        $objCollection = Collection::find($intCollectionId);
        $arrFormData = array(
            'title'       => $objCollectionUpdateRequest->title,
            'slug'        => (new CreateSlug())->get($objCollectionUpdateRequest->title),
            'description' => $objCollectionUpdateRequest->description
        );
        $objCollection->update($arrFormData);

        return response()->json($objCollection);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request   $objRequest
     * @param  int  $intCollectionId
     * @return \Illuminate\Http\Response
     */
    public function postAddResourceToCollection(Request $objRequest,$intCollectionId) {
        $objCollection = Collection::find($intCollectionId);
        $objCollection->resources()->attach($objRequest->id);
        $objCollection->resources;
        return response()->json($objCollection);

    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request   $objRequest
     * @param  int $intCollectionId
     * @return \Illuminate\Http\Response
     */
    public function postRemoveResourceToCollection(Request $objRequest,$intCollectionId) {

        $objCollection = Collection::findOrFail($intCollectionId);
        $objCollection->resources()->detach($objRequest->id);
        $objCollection->resources;
        return response()->json($objCollection);
    }

    /**
     * add in favorites
     * @param $intUserId
     */
    public function postSetFavorite($intUserId) {
        $boolIsFavoritted = Redis::SISMEMBER('favorite:vuecollection', $intUserId);
        if ($boolIsFavoritted == 1) {
            Redis::srem('favorite:vuecollection', $intUserId);
        } else {
            Redis::sadd('favorite:vuecollection', $intUserId);
        }
        return response()->json(['id' => $intUserId, 'status' => 200, 'message', 'Success']);
    }

    /**
     * for search  specified collection
     * @param $objRequest
     * @return $arrObjSearch
     */
    public function collectionSearch(Request $objRequest) {

        $arrObjSearch = Collection::where('title',$objRequest->search)->get();
        return response()->json($arrObjSearch);

    }

    /**
     * for view search  page
     * @return view
     */
    public function search() {
        return view('search');

    }
}
