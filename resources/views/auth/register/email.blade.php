@extends('app')

@section('layout', 'login')

@section('body')
<div class="tbl main-container">
    <div class="tbl-cell tbl-cell-middle">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    @include('partials.formerror')
                    <h3>Регистрация в {{ $workspace->domain_prefix.'.'.env('APP_DOMAIN') }}</h3>
                    <p>Введите ваш email в зоне {{ $workspace->domain }}</p>
                    <br/>
                    {!! Form::open() !!}
                    <div class="form-group center-block">
                        <div class="input-group input-group-lg">
                            <input type="text" name="email" class="form-control text-right" autofocus />
                            <span class="input-group-addon">{{ '@'.$workspace->domain }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Продолжить', ['class' => 'btn btn-success btn-lg btn-block']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
