@extends('main')

@section('layout', 'login')

@section('body')
<div class="tbl main-container">
    <div class="tbl-cell tbl-cell-middle">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    @include('partials.formerror')
                    <h3>Создание Workspace</h3>
                    <p>Введите ваш email и имя workspace.</p>
                    <br/>
                    {!! Form::open() !!}
                    <div class="form-group">
                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('workspace', null, ['class' => 'form-control', 'placeholder' => 'Workspace']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Продолжить', ['class' => 'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
