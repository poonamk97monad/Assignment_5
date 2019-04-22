@extends('parent')

@section('main')
    @if(!empty($searchResource))
        @foreach($searchResource as $title)
            <h1>{{ $title->title }} </h1>
        @endforeach
    @endif
@endsection
