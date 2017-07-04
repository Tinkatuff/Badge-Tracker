@extends('layouts.app')

@section('page-title', sprintf('%s | Challenger Profile', $challenger))

@section('content')
	<div class="container" id="challenger-profile">
		<h1 class="subtitled">Challenger</h1>
		<h2>{{ $challenger }}</h2>

		<div class="row">
			<div class="col-md-8">

				<h3>Badges: {{ $current_season }}</h3>

				<div class="row badge-list">
					@foreach ($season_badges as $badge)
						<div class="col-xs-4 col-sm-3 equal-height">
							<div class="badge-league">
								<div class="well">
									<img src="{{ $badge->image_url }}" alt="{{ $badge }}">
								</div>
								<div class="badge-name">{{ $badge->name }}</div>
							</div>
						</div>
					@endforeach

					@foreach ($season_badges_inactive as $badge)
						<div class="col-xs-4 col-sm-3 equal-height">
							<div class="badge-league inactive">
								<div class="well">
									<img src="{{ $badge->image_url }}" alt="{{ $badge }}" class="equal-height">
								</div>
								<div class="badge-name">{{ $badge->name }}</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
			<div class="col-md-4">
				<div class="challenger-info">
					<div class="since">Challenger Since <strong>{{ $challenger->joined_season }}</strong></div>

						@foreach ($challenger->data as $data)
							<div class="line">
								<label>{{ $data->name }}</label>
								<div class="data">{{ $data }}</div>
							</div>
						@endforeach
						<div class="line">
							<label>Joined</label>
							<div class="data">{{ $challenger->join_date }}</div>
						</div>


						@if (!$challenger->social->isEmpty())
							<div class="social-media">
							@foreach ($challenger->social as $social)
								<a href="{{ $social->url }}" target="_blank"><i class="fa fa-{{ $social->service }}-square"></i></a>
							@endforeach
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@stop