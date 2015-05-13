@extends('main')

@section('content')
    @if (count($workspaces))

    @else
        <div class="page-header">
            <h3>Вы не состоите ни в одной команде</h3>
        </div>
        <p>Внутри команды вы можете создавать общедоступные проекты, управлять задачами и взаимодействовать с другими пользователями.</p>
        <p>
        Вы можете
        <a href="{{ url('/workspace/connect') }}" class="btn btn-success btn-sm">Присоединиться к команде</a>
        или
        <a href="{{ url('/workspace/create') }}" class="btn btn-primary btn-sm">Создать команду</a>
        </p>
    @endif
@stop