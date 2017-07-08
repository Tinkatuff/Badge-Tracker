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
				data-target="#navbar" 
				aria-expanded="false">

			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('home') }}">
				<img alt="{{ config('app.name') }}" src="{{ asset('images/logo.png') }}">
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="nav navbar-nav">
				<li class="{{ App\class_if_route('active', 'challenger.*') }}">
					<a href="{{ route('challenger.index') }}">Challengers</a>
				</li>
				@if (Auth::check() && Auth::user()->isAdmin())
					<li class="{{ App\class_if_route('active', 'admin.challenger.create') }}">
						<a href="{{ route('admin.challenger.create') }}"><i class="fa fa-plus"></i> New Challenger</a>
					</li>
				@endif
			</ul>
			
			<div class="clearfix">
				<a class="btn btn-facebook navbar-btn" href="https://www.facebook.com/groups/418038738406752" target="_blank">
					<i class="fa fa-facebook" aria-title="Facebook" aria-hidden="true"></i>
					Join <span class="visible-xs-inline">Facebook</span> Group
				</a>
				@if (Auth::check())
					<ul class="nav navbar-nav">
						<li>
							<a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Log Out</a>
						</li>
					</ul>
				@endif
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
		Visit our <a href="https://www.facebook.com/TeamRocketAZ">Facebook Page</a> for more info!
	</footer>
@stop