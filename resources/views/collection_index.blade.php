@extends('parent')

@section('main')
    @if ($strMessage =Session::get('success') )
        <div class="alert alert-success">
            <p>{{$strMessage}}</p>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#collectionsModal">Add New Collections</button>
    <hr>
    <h2>Collections</h2>
    <hr>
    <table class="table table-bordered table-striped">
        <tr>
            <th width="35%">Title</th>
            <th width="35%">Slug</th>
            <th width="35%">Description</th>
            <th width="30%">Action</th>
        </tr>
        @foreach($arrObjCollectionData as $objCollectionData)
            <tr>
                <td>{{ $objCollectionData->title }}</td>
                <td>{{ $objCollectionData->slug }}</td>
                <td>{{ $objCollectionData->description }}</td>
                <td>
                    <a href="{{route('collection.show',$objCollectionData->id)}}" class="btn btn-primary">view</a>
                </td>
            </tr>
        @endforeach
    </table>
    <hr>
    {!! $arrObjCollectionData->links() !!}
    <div class="modal fade" id="collectionsModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="favoritesModalLabel">Resources list</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <form method="post" action="{{ route('collection.store') }}" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-4 text-right">Enter Title of File</label>
                                <div class="col-md-8">
                                    <input type="text" name="title" class="form-control input-lg" />
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <br/>
                            <div class="form-group">
                                <label class="col-md-4 text-right">Enter Slug</label>
                                <div class="col-md-8">
                                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="post-slug"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 text-right">Enter Description</label>
                                <div class="col-md-8">
                                    <input type="text" name="description" class="form-control input-lg" />
                                </div>
                            </div>
                            <br /><br /><br />
                            <div class="form-group text-center">
                                <input type="submit" name="add" class="btn btn-primary input-lg" value="Add" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection
