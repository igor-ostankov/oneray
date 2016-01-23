@extends('main')

@section('layout', 'login')

@section('body')
<div class="tbl main-container">
    <div class="tbl-cell tbl-cell-middle">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <h3>Сообщение было отправлено на {{ $email }}</h3>
                    <p>Для продолжения регистрации пройдите по ссылке в письме</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
