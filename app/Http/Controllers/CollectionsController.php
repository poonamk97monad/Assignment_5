<?php

namespace App\Http\Controllers;

use App\Module\Resource;
use App\Module\Collection;
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

        $arrObjCollections = Collection::latest()->paginate(5)
        ;
        return view('collection_index', compact('arrObjCollections'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('create_collections');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $strRequest
     * @return \Illuminate\Http\Response
     */
    public function store(Request $strRequest) {

        $strRequest->validate([
            'title'          =>  'required',
            'slug'           =>  'required',
            'description'    =>  'required'
        ]);
        $arrFormData = array(
            'title'              =>   $strRequest->title,
            'slug'               =>   $strRequest->slug,
            'description'        =>   $strRequest->description
        );

        Collection::create($arrFormData);
        return redirect('collection')->with('success', 'Data Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($intId) {

        $objCollection      = Collection::findOrFail($intId);
        $arrObjResources    = Resource::all();

        return view('collection_view', array('objCollection' => $objCollection, 'arrObjResources' => $arrObjResources));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($intId) {

        $objData = Resource::findOrFail($intId);

        $arrFormData = array(
            'title'              =>   $objData->title,
            'slug'               =>   $objData->slug,
            'description'        =>   $objData->description
        );

        Collection::create($arrFormData);

        return redirect('collection_view',compact('$arrFormData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $intCollectionId,$intResourceId
     * @return \Illuminate\Http\Response
     */
    public function update($intCollectionId,$intResourceId) {
        $objCollection = Collection::find($intCollectionId);
        $objCollection->resources()->attach($intResourceId);

        return redirect('collection/'.$intCollectionId)->with('success', 'Data is successfully deleted');;
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $intCollectionId,$intResourceId
     * @return \Illuminate\Http\Response
     */
    public function destroy($intCollectionId,$intResourceId) {

        $objCollection = Collection::findOrFail($intCollectionId);
        $objCollection->resources()->detach($intResourceId);
        return redirect('collection/'.$intCollectionId)->with('success', 'Data is successfully deleted');
    }

    /**
     * add in favorites
     * @param $intUserId
     */
    public function setFavorite($intUserId) {
        $boolIsFavoritted = Redis::SISMEMBER('favorite:collection', $intUserId);
        if($boolIsFavoritted == 1) {
            $objRedis = Redis::srem('favorite:collection', $intUserId);
        }
        else {
            $objRedis = Redis::sadd('favorite:collection', $intUserId);
        }
        return redirect()->back();
    }

}
