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
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="app">
        <div class="container" >
            <div class="container" >
            <div class="row">
                <div class="col-md-3">
                    <resources></resources>
                </div>
            </div>

                <div class="container" >
                <div class="col-md-9">
                    <resources-index></resources-index>
                </div>
                </div>
            </div>
        </div>
    </div>
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
<script src="{{ asset('js/app.js') }}"></script>

