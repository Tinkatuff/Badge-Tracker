<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="icon" type="image/png" href="{{ asset('images/favicon-32x32.png') }}" sizes="32x32" />
	<link rel="icon" type="image/png" href="{{ asset('images/favicon-16x16.png') }}" sizes="16x16" />

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