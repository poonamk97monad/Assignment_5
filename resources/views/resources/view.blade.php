@extends('resources.parent')

@section('main')

    <div class="jumbotron text-center">
        <div align="right">
            <a href="{{ route('resource.index') }}" class="btn btn-default">Back</a>
        </div>
        <br />
        <img src="{{ URL::to('/') }}/file_upload/{{ $objData->file_upload }}"  />
        <h3>Title - {{ $objData->title }} </h3>
        <h3>Description - {{ $objData->description }}</h3>
    </div>
@endsection
