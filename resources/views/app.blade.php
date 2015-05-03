<!DOCTYPE html>
<html lang="en" class="@yield('layout')">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/layout.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
</head>
<body>
    {{--<a href="{{ url('/') }}">Home</a>--}}
    {{--{{ Auth::user()->name }}--}}
    {{--@if (Auth::guest())--}}
        {{--<li><a href="{{ url('/auth/login') }}">Login</a></li>--}}
        {{--<li><a href="{{ url('/auth/register') }}">Register</a></li>--}}
    {{--@else--}}
        {{--<li class="dropdown">--}}
            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="caret"></span></a>--}}
            {{--<ul class="dropdown-menu" role="menu">--}}
                {{--<li><a href="{{ url('/auth/logout') }}">Logout</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}
    {{--@endif--}}

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
