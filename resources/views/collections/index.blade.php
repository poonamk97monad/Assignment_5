@extends('collections.parent')
@section('main')
    <div>
        <a href="{{route('collection.create')}}" class="btn btn-success">Add</a>
    </div>

    @if ($strMessage =Session::get('success') )
        <div class="alert alert-success">
            <p>{{$strMessage}}</p>
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <tr>
            <th width="35%">Title</th>
            <th width="35%">Slug</th>
            <th width="35%">Description</th>
            <th width="30%">Action</th>
        </tr>
        @foreach($objData as $strRow)
            <tr>
                <td>{{ $strRow->title }}</td>
                <td>{{ $strRow->slug }}</td>
                <td>{{ $strRow->description }}</td>
                <td>
                    <a href="{{route('collection.show',$strRow->id)}}" class="btn btn-primary">Show</a>

                </td>
            </tr>
        @endforeach
    </table>
    {!! $objData->links() !!}
@endsection
