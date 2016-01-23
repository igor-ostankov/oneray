@extends('main')

@section('layout', 'app')

@section('body')
    <div class="container messages">
        @if ($errors->any())
            <ul class="list-unstyled alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @if (Session::has('flash_msg'))
            <div class="alert alert-{{ Session::get('flash_type', 'info') }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span>{{ Session::get('flash_msg') }}</span>
            </div>
        @endif
    </div>

    <div id="app"></div>
	@include('partials.jsvars')
    <script src="/js/app.js"></script>
@endsection
