@extends('app')

@section('layout', 'login')

@section('body')
<div class="tbl main-container">
    <div class="tbl-cell tbl-cell-middle">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <h3>Введенный email уже зарегистрирован в {{ $workspace->domain_prefix.'.'.env('APP_DOMAIN') }}</h3>
                    <a href="{{ url('/login') }}">Войдите</a> или
                    <a href="{{ url('/password/email') }}">восстановите пароль</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
