@extends('resources.parent')

@section('main')
    <div>
        <a href="{{route('resource.create')}}" class="btn btn-success">Add</a>
    </div>

    @if ($strMessage =Session::get('success') )
        <div class="alert alert-success">
            <p>{{$strMessage}}</p>
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <tr>
            <th width="10%">File</th>
            <th width="35%">Title</th>
            <th width="35%">Slug</th>
            <th width="35%">Description</th>
            <th width="30%">Action</th>
        </tr>
        @foreach($objData as $strRow)
            <tr>
                <td><a href="{{ URL::to('/') }}/file_upload/{{ $strRow->file_upload }}">{{ $strRow->file_upload }}</a></td>
                <td>{{ $strRow->title }}</td>
                <td>{{ $strRow->slug }}</td>
                <td>{{ $strRow->description }}</td>
                <td>
                    <a href="{{route('resource.show',$strRow->id)}}" class="btn btn-primary">Show</a>
                    <a href="{{route('resource.edit',$strRow->id)}}" class="btn btn-success">Edit</a>
                    <form action="{{ route('resource.destroy',$strRow->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                    </form>

                </td>
            </tr>
        @endforeach
    </table>
    {!! $objData->links() !!}
@endsection
