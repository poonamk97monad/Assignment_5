@extends('parent')

@section('main')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div align="right">
        <a href="{{ route('collection.index') }}" class="btn btn-default">Back</a>
    </div>
    <br />
    <form method="post" action="{{ route('collection.update', $objData->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label class="col-md-4 text-right">Enter File Title </label>
            <div class="col-md-8">
                <input type="text" name="title" value="{{ $objData->title }}" class="form-control input-lg" />
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div class="form-group">
            <label class="col-md-4 text-right">Enter File description</label>
            <div class="col-md-8">
                <input type="text" name="description" value="{{ $objData->description }}" class="form-control input-lg" />
            </div>
        </div>
        <br />
        <br />
        <br />
        <div class="form-group">
            <label class="col-md-4 text-right">Select file</label>
            <div class="col-md-8">
                <input type="file" name="file_upload" />
                <img src="{{ URL::to('/') }}/file_upload/{{ $objData->file_upload }}" class="img-thumbnail" width="100" />
                <input type="hidden" name="hidden_image" value="{{ $objData->file_upload }}" />
            </div>
        </div>
        <br /><br /><br />
        <div class="form-group text-center">
            <input type="submit" name="edit" class="btn btn-primary input-lg" value="Edit" />
        </div>
    </form>

@endsection
