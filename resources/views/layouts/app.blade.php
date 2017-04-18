@extends('layouts.master')

@push('styles')
	<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
	<script>
		window.Laravel = {!! json_encode([
			'csrfToken' => csrf_token(),
		]) !!};
	</script>
	<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endpush

@section('body')
	{{-- For vue --}}
	<div id="app">
		@parent
	</div>
@endsection

@section('header')
	<nav class="navbar navbar-default">
		<div class="navbar-header">
			<button type="button" 
				class="navbar-toggle collapsed" 
				data-toggle="collapse" 
				data-target="#bs-example-navbar-collapse-1" 
				aria-expanded="false">

			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">{{ config('app.name') }}</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="active">
					<a href="#">Challengers</a>
				</li>
			</ul>
			
			<div class="navbar-form">
				<a class="btn btn-facebook pull-right" href="" target="_blank">
					<i class="fa fa-facebook" aria-title="Facebook" aria-hidden="true"></i>
					Join Group
				</a>
			</div>
		</div><!-- /.navbar-collapse -->
	</nav>
@stop

@section('main')
	<main>
		@yield('content')
	</main>
@stop

@section('footer')
	<footer>
		The Team Rocket AZ Pokemon League is a fan-run challenge hosted in the Phoenix, AZ metro area.
		Visit our <a href="#">Facebook Page</a> for more info!
	</footer>
@stop