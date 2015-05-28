@extends('app')

@section('layout', 'login')

@section('body')
    <div class="tbl main-container">
        <div class="tbl-cell tbl-cell-middle">
            <div class="container-fluid">
                <div class="text-center center-block" style="width: 280px;">
                    @include('partials.formerror')
                    <h3>Авторизация в OneRay</h3>
                    <br>
                    <p>Введите имя домена в зоне oneray.ru</p>
                    {!! Form::open() !!}

                    <div class="form-group center-block">
                        <div class="input-group input-group-lg">
                            {!! Form::text('workspace', null,
                                ['class' => 'form-control text-right', 'placeholder' => 'Имя домена', 'autofocus' => true]) !!}
                            <span class="input-group-addon">.{{ env('APP_DOMAIN') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Продолжить', ['class' => 'btn btn-success btn-lg btn-block']) !!}
                    </div>

                    {!! Form::close() !!}

                    <br>
                    <hr>
                    <a href="{{ url('create') }}">Создать Workspace</a>
                </div>
            </div>
        </div>
    </div>
@stop