@extends('layouts.app')

@section('page-title', 'Challenger Directory')

@section('meta')
	<meta property="og:title" content="Challenger listing for the Team Rocket AZ Pokémon League">
	<meta property="og:image" content="{{ asset('images/facebook-preview.jpg') }}">
	<meta property="og:site_name" content="TRAZ Pokémon League">
	<meta property="og:description" content="Search and view the progress of challengers of the Team Rocket AZ Pokémon League based in the Phoenix, AZ metro area.">
@stop

@section('content')
	<div class="container" id="challengers">
		<div class="row">
			<div class="col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">
				<div class="row">
					<div class="col-sm-6">
						<h1>Challenger Directory</h1>
					</div>
					<div class="col-sm-6">
						<form class="filter" data-container=".challenger-list" data-items=".challenger">
							<div class="input-group">
								<input type="text" data-search=".name" class="form-control" placeholder="Filter Challengers">
								<span class="input-group-btn">
									<button class="btn btn-default" type="submit">
										<i class="fa fa-search" aria-hidden="true" aria-title="Search"></i>
									</button>
								</span>
							</div>
						</form>
					</div>
				</div>

				<div class="key">
					<div class="badges">
						<i class="fa fa-shield-alt stats-icon" aria-hidden="true" title="5 of 18 Badges Won"></i> Badges earned in {{ App\Models\Season::currentSeason() }}
					</div>
				</div>

				<ol class="challenger-list">
					@forelse ($challengers as $challenger)
						<li class="challenger">
							<a href="{{ route('challenger.show', $challenger) }}">
								<h2 class="name">{{ $challenger->name }}</h2>
								<div class="stats">
									<span class="badges">
										<i class="fa fa-shield-alt" aria-hidden="true" title="5 of 18 Badges Won"></i>
										{{ $challenger->current_season_badges }} <span class="badges-total">/ {{ $season_badges }}</span>
									</span>
									@if ($challenger->type)
										<span class="trainer-type" title="{{ $challenger->type }} Type Trainer">
											<i class="{{ $challenger->type->icon  }} fa-fw" aria-hidden="true"></i>
											<span class="trainer-type-points">{{ $challenger->current_season_type_points}}</span>
										</span>
									@endif
								</div>
							</a>
						</li>
					@empty
						<li><em>There are no challengers with badges this season.</em></li>
					@endforelse
				</ol>
			</div>
		</div>
	</div>
@endsection