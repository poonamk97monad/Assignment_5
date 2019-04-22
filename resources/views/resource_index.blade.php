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
    <h5 class="right">
        <form action="/search" method="get">
            <input type="text" name="search">
            <input type="submit" value="Search">
        </form>
    </h5>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#resourceModal">Add New Resource</button>
    <hr>
    <h2>Resources</h2>
    <hr>
    <table class="table table-bordered table-striped">
        <tr>
            <th width="35%">Files</th>
            <th width="35%">Title</th>
            <th width="35%">Slug</th>
            <th width="35%">Description</th>
            <th width="30%">Action</th>
        </tr>
        @foreach($arrObjResource as $objResource)
            <tr>
                <td><img src="{{ URL::to('/') }}/file_upload/{{ $objResource->file_upload }}"  />{{ $objResource->file_upload }}</td>
               {{-- <td><a href="{{ URL::to('/') }}/file_upload/{{ $objResourceData->file_upload }}">{{ $objResourceData->file_upload }}</a></td>--}}
                <td>{{ $objResource->title }}</td>
                <td>{{ $objResource->slug }}</td>
                <td>{{ $objResource->description }}</td>
                <td>
                    <a href="{{route('resource.show',$objResource->id)}}" class="btn btn-primary">view</a>
                </td>
                <td>
                    <form action="/add_favorites_resource/{{$objResource->id}}" method="post">
                        {{ csrf_field() }}
                        @if($objResource->isFavortted() == 1)
                            <button class="btn btn-success">UnFavorites</button>
                        @else
                            <button class="btn btn-success">Favorites</button>
                        @endif
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <hr>
    {!! $arrObjResource->links() !!}

    <div class="modal fade" id="resourceModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
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

                        <form method="post" action="{{ route('resource.store') }}" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-4 text-right">Enter Title of File</label>
                                <div class="col-md-8">
                                    <input type="text" name="title" class="form-control input-lg" />
                                </div>
                            </div>
                            <br />
                            <br />
                            <br />
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
                            <br />
                            <br />
                            <br />
                            <div class="form-group">
                                <label class="col-md-4 text-right">Select file upload</label>
                                <div class="col-md-8">
                                    <input type="file" name="file_upload" />
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
