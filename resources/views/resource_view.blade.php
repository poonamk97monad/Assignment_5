@extends('parent')

@section('main')
    <div class="jumbotron text-center">
        <div align="right">
            <a href="{{ route('resource.index') }}" class="btn btn-default">Back</a>
        </div>
        <br/>
        <h2><a href="{{ URL::to('/') }}/file_upload/{{ $arrObjResources->file_upload }}">{{ $arrObjResources->file_upload }}</a></h2>
        <h3>Title - {{ $arrObjResources->title}} </h3>
        <h3>Slug - {{ $arrObjResources->slug }} </h3>
        <h3>Description - {{ $arrObjResources->description }}</h3>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#resources">Add Resources</button>
    <hr>
    <h3>list of collection items of this resources</h3>
    @if($arrObjResources->collections->count())
        <table class="table table-bordered table-striped">
            <tr>
                <th width="35%">Title</th>
                <th width="35%">Slug</th>
                <th width="35%">Description</th>
                <th width="30%">Action</th>
            </tr>
            @foreach($arrObjResources->collections as $objCollection)
                <tr>
                    <td>{{ $objCollection->title }}</td>
                    <td>{{ $objCollection->slug }}</td>
                    <td>{{ $objCollection->description }}</td>
                    <td>
                        <form action="/delete_resource/{{$arrObjResources->id}}/{{ $objCollection->id}}" method="post">
                            {{ csrf_field() }}
                            <button class="btn btn-danger">Remove From Collection</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
    <div class="modal fade" id="resources"
         tabindex="-1" role="dialog"
         aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="favoritesModalLabel">All Collection list</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <form method="post" action="{{ route('collection.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @if($arrObjCollection->count())
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th width="35%">Title</th>
                                        <th width="35%">Slug</th>
                                        <th width="35%">Description</th>
                                        <th width="30%">Action</th>
                                    </tr>
                                    @foreach($arrObjCollection as $objCollection)
                                        <tr>
                                            <td>{{ $objCollection->title }}</td>
                                            <td>{{ $objCollection->slug }}</td>
                                            <td>{{ $objCollection->description }}</td>
                                            <td>
                                                <form action="/add_resource/{{$arrObjResources->id}}/{{ $objCollection->id}}" method="post">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-info">Add to resource</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
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
