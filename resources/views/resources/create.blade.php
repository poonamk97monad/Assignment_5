@extends('resources.parent')

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
        <a href="{{ route('resource.index') }}" class="btn btn-default">Back</a>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

@endsection
