<?php

namespace App\Http\Controllers;
use App\Module\Resource;
use App\Module\Collection;
use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $arrObjResourceData = Resource::latest()->paginate(5);
        return view('resource_index', compact('arrObjResourceData'))
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
    public function store(Request $strRequest) {
        $strRequest->validate([
            'title'          =>  'required',
            'slug'           =>  'required',
            'description'    =>  'required',
            'file_upload'    =>  'required'
        ]);
        $arrFormData = array(
            'title'              =>   $strRequest->title,
            'slug'               =>   $strRequest->slug,
            'description'        =>   $strRequest->description,
            'file_upload'        =>   $strRequest->file_upload
        );

        Resource::create($arrFormData);
        return redirect('resource')->with('success', 'Data Added successfully.');
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

        return view('resource_view', array('arrObjCollection' => $arrObjCollection, 'arrObjResources' => $arrObjResources));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $intId
     * @param  string $strRequest
     * @return \Illuminate\Http\Response
     */
    public function update($intResourceId,$intCollectionId) {
        $objResource = Resource::find($intResourceId);
        $objResource->collections()->attach($intCollectionId);

        return redirect('resource/'.$intResourceId)->with('success', 'Data is successfully deleted');;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $intId
     * @return \Illuminate\Http\Response
     */
    public function destroy($intResourceId,$intCollectionId) {

        $objResource = Resource::findOrFail($intResourceId);
        $objResource->collections()->detach($intCollectionId);
        return redirect('resource/'.$intResourceId)->with('success', 'Data is successfully deleted');
    }
}
