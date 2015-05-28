@extends('app')

@section('layout', 'login')

@section('body')
<div class="tbl main-container">
    <div class="tbl-cell tbl-cell-middle">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <h3>Создание workspace {{ $workspaceDomainPrefix.'.'.env('APP_DOMAIN') }}</h3>
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

                    <form class="form-horizontal" role="form" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <input type="text" placeholder="Название workspace" class="form-control" name="workspace_name" value="{{ old('workspace_name') }}">
                        </div>

                        @if (!$userExists)
                        <div class="form-group">
                            <input type="text" placeholder="Имя" class="form-control" name="first_name" value="{{ old('first_name') }}">
                        </div>

                        <div class="form-group">
                            <input type="text" placeholder="Фамилия" class="form-control" name="last_name" value="{{ old('last_name') }}">
                        </div>

                        <div class="form-group">
                            <input type="password" placeholder="Пароль" class="form-control" name="password">
                        </div>

                        <div class="form-group">
                            <input type="password" placeholder="Подтверждение пароля" class="form-control" name="password_confirmation">
                        </div>
                        @endif
                        <br/>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Зарегистрировать
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
