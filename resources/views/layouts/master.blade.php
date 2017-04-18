<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
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