@extends('app')

@section('layout', 'login')

@section('content')
<div class="tbl main-container">
    <div class="tbl-cell tbl-cell-middle">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <h3>Авторизация в OneRay</h3>
                    <br>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ url('/auth/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <input type="email" placeholder="E-mail" class="form-control" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <input type="password" placeholder="Пароль" class="form-control" name="password">
                        </div>

                        <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Запомнить меня
                                    </label>
                                </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Войти</button>
                        </div>

                    </form>
                    <hr/>
                    <div>Нет аккаунта - <a class="text-success" href="{{ url('/auth/register') }}">Зарегистрируйтесь</a></div>
                    <div>Не получается войти - <a href="{{ url('/password/email') }}">Восстановите пароль</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
