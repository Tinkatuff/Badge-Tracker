<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	@yield('meta')

	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('images/apple-touch-icon-57x57.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/apple-touch-icon-114x114.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/apple-touch-icon-72x72.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/apple-touch-icon-144x144.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('images/apple-touch-icon-120x120.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('images/apple-touch-icon-152x152.png') }}" />
	<link rel="icon" type="image/png" href="{{ asset('images/favicon-32x32.png') }}" sizes="32x32" />
	<link rel="icon" type="image/png" href="{{ asset('images/favicon-16x16.png') }}" sizes="16x16" />
	<meta name="application-name" content="TRAZ League"/>
	<meta name="msapplication-TileColor" content="#000000" />
	<meta name="msapplication-TileImage" content="{{ asset('images/mstile-144x144.png') }}" />

	<title>
		@hasSection('page-title')
			@yield('page-title') |
		@endif
		{{ config('app.name') }}
	</title>
	@stack('styles')
</head>
<body>
	@section('body')
		@yield('header')
		@yield('main')
		@yield('footer')
	@show
	@stack('modals')
	@stack('scripts')
</body>
</html>