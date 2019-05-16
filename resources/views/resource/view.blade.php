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
<div id="resource-app">
    <div class="row">
        <div class="col-md-7">
            <resources-view :objResource="{{ json_encode($arrObjResource) }}"></resources-view>
        </div>
    </div>
</div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
