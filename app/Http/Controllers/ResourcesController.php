<?php

namespace App\Http\Controllers;

use App\Helpers\CreateSlug;
use App\Module\Resource;
use App\Module\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\StoreAddResourceToCollection;

class ResourcesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $arrObjResource = Resource::latest()->paginate(5);
        return view('resource.index', compact('arrObjResource'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddResourceToCollection $objResourcetoCollectionRequest) {

        /*$file_upload = $objResourcetoCollectionRequest->file('file_upload');
        $strNewName = rand() . '.' .  $file_upload->getClientOriginalExtension();
        $file_upload->move(public_path('file_upload'), $strNewName);*/
        $arrFormData = array(
            'title'              =>   $objResourcetoCollectionRequest->title,
            'slug'               =>   (new CreateSlug())->get($objResourcetoCollectionRequest->title),
            'description'        =>   $objResourcetoCollectionRequest->description,
            'file_upload'        =>   $objResourcetoCollectionRequest->file_upload
        );
        Resource::create($arrFormData);
        return redirect('resources')->with('success', 'Data Added successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $intId
     * @return \Illuminate\Http\Response
     */
    public function show($intId) {
        $arrObjResources      = Resource::findOrFail($intId);
        $arrObjCollection     = Collection::all();

        return view('resource.view', array('arrObjCollection' => $arrObjCollection, 'arrObjResources' => $arrObjResources));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $obRequest
     * @param  $intResourceId
     * @return \Illuminate\Http\Response
     */
    public function postAddToCollection(Request $obRequest, $intResourceId) {
        $objResource = Resource::find($intResourceId);
        $objResource->collections()->attach($obRequest->get('collection_id'));
        return redirect('resources/'.$intResourceId)->with('success', 'Data is successfully deleted');;
    }

    /**
     * Remove the specified resource from storage.
     * @param  $intResourceId
     * @return \Illuminate\Http\Response
     */
    public function postRemoveToCollection(Request $obRequest, $intResourceId) {
        $objResource = Resource::find($intResourceId);
        $objResource->collections()->detach($obRequest->get('collection_id'));
        return redirect('resources/'.$intResourceId)->with('success', 'Data is successfully deleted');
    }


    /**
     * Add in favrite
     * @param $intUserId
     * @return redirect
     */
    public function postSetFavorite($intUserId) {
        $boolIsFavoritted = Redis::SISMEMBER('favorite:resource', $intUserId);
        if($boolIsFavoritted == 1) {
            $objRedis = Redis::srem('favorite:resource', $intUserId);
        }
        else {
            $objRedis = Redis::sadd('favorite:resource', $intUserId);
        }
        return redirect()->back();
    }

    /*public function search() {

        $strSearch = request()->get('search');
        $searchResource = Resource::search($strSearch)->get();
        dd($searchResource);
        return view('search', compact('searchResource'));*/
       /* $objResource  = new Resource;
        $objResource ->save();*/
      /*  $objResource  = Resource::save();*/
//        $test = Resource::all()->searchable();
//        $searchResource = Resource::where('title', '=', $strSearch)->searchable(;
//        $orders = App\Order::search('Star Trek')->get();
//        $searchResource = Resource::searchByQuery(['match' => ['title' => $strSearch]]);

   // }
}
