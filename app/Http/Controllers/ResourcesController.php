<?php

namespace App\Http\Controllers;
use App\Module\Resource;
use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $objData = Resource::latest()->paginate(5);
        return view('resources.index', compact('objData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('resources.create');
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

        /*$strFileUpload = $strRequest->file('file_upload');*/
       /* $strNewName = rand() . '.' . $strFileUpload->getClientOriginalExtension();
        $strFileUpload->move(public_path('file_upload'), $strNewName);*/
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
        $objData = Resource::findOrFail($intId);
        return view('resources.view', compact('objData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $intId
     * @return \Illuminate\Http\Response
     */
    public function edit($intId) {
        $objData = Resource::findOrFail($intId);
        return view('resources.edit', compact('objData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $intId
     * @param  string $strRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $strRequest, $intId) {
        $strFileUploadName = $strRequest->hidden_file_upload;
        $strFileUpload = $strRequest->file('file_upload');
        if($strFileUpload != '') {
            $strRequest->validate([
                'title'           =>  'required',
                'slug'            =>  'required',
                'description'     =>  'required',
                'file_upload'     =>  'required'
            ]);

            $strFileUploadName = rand() . '.' . $strFileUpload->getClientOriginalExtension();
            $strFileUpload->move(public_path('file_upload'), $strFileUploadName);
        }
        else {
            $strRequest->validate([
                'title'           =>  'required',
                'description'     =>  'required'
            ]);
        }

        $arrFormData = array(
            'title'            =>   $strRequest->title,
            'slug'             =>   $strRequest->slug,
            'description'      =>   $strRequest->description,
            'file_upload'      =>   $strFileUploadName
        );

        Resource::whereId($intId)->update($arrFormData);

        return redirect('resource')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $intId
     * @return \Illuminate\Http\Response
     */
    public function destroy($intId) {

        $objData = Resource::findOrFail($intId);
        $objData->delete();

        return redirect('resource')->with('success', 'Data is successfully deleted');
    }
}
