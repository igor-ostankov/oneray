@extends('main')

@section('content')
    <div class="page-header">
        <h3>Профиль пользователя <small>{{ $user->getName() }}</small></h3>
    </div>

    <div class="row">
        <div class="col-md-6">
            {!! Form::model($user, ['method' => 'PATCH', 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('first_name', 'Имя:', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('last_name', 'Фамилия:', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('email', 'E-mail:', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <hr/>

            <div class="form-group">
                {!! Form::label('password', 'Пароль:', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('password', '', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation', 'Подтверждение:', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('password_confirmation', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <hr/>

            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    {!! Form::submit('Сохранить', ['class' => 'btn btn-success']) !!}
                </div>
            </div>


            {!! Form::close() !!}
        </div>
    </div>
@endsection