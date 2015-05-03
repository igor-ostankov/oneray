@extends('app')

@section('layout', 'login')

@section('content')
<div class="tbl main-container">
    <div class="tbl-cell tbl-cell-middle">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <h3>Сброс пароля</h3>
                    <br/>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <input type="email" placeholder="E-mail" class="form-control" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <input type="password" placeholder="Пароль" class="form-control" name="password">
                        </div>

                        <div class="form-group">
                            <input type="password" placeholder="Подтверждение пароля" class="form-control" name="password_confirmation">
                        </div>
                        <br/>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Сбросить пароль
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
