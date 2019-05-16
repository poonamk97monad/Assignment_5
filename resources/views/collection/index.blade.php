
@extends('parent')
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
<div id="app">
    <div class="container" >
        <div class="container" >
            <div class="row">
                <div class="col-md-3">
                    <collection></collection>
                </div>
            </div>
            <div class="container" >
                <div class="col-md-9">
                    <collection-index></collection-index>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
