@extends('parent')

@section('main')
    <div class="jumbotron text-center">
        <div align="right">
            <a href="{{ route('collections.index') }}" class="btn btn-default">Back</a>
        </div>
        <br/>
        <h3>Title - {{ $objCollection->title}} </h3>
        <h3>Slug - {{ $objCollection->slug }} </h3>
        <h3>Description - {{ $objCollection->description }}</h3>
    </div>
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#resources">Add Resources</button>
    <hr>
    <h3>list of resources items of this collection</h3>
    @if($objCollection->resources->count())
        <table class="table table-bordered table-striped">
            <tr>
                <th width="35%">File</th>
                <th width="35%">Title</th>
                <th width="35%">Slug</th>
                <th width="35%">Description</th>
                <th width="30%">Action</th>
            </tr>
            @foreach($objCollection->resources as $objResource)
                <tr>
                    <td><img src="{{ URL::to('/') }}/file_upload/{{ $objResource->file_upload }}" class="img-thumbnail" width="75"/></td>
                    <td>{{ $objResource->title }}</td>
                    <td>{{ $objResource->slug }}</td>
                    <td>{{ $objResource->description }}</td>
                    <td>
                        <form action="/remove-to-resources/{{$objCollection->id}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="resource_id" value="{{ $objResource->id}}">
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
                        id="favoritesModalLabel">All Resources list</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <form method="post" action="{{ route('collections.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @if($arrObjResources->count())
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th width="35%">File</th>
                                        <th width="35%">Title</th>
                                        <th width="35%">Slug</th>
                                        <th width="35%">Description</th>
                                        <th width="30%">Action</th>
                                    </tr>
                                    @foreach($arrObjResources as $objResource)
                                        <tr>
                                            <td><img src="{{ URL::to('/') }}/file_upload/{{ $objResource->file_upload }}" class="img-thumbnail" width="75"/></td>
                                            <td>{{ $objResource->title }}</td>
                                            <td>{{ $objResource->slug }}</td>
                                            <td>{{ $objResource->description }}</td>
                                            <td>
                                                <form action="collection/add-to-resources/{{$objCollection->id}}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="resource_id" value="{{ $objResource->id}}">
                                                    <button class="btn btn-info">Add to collection</button>
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
