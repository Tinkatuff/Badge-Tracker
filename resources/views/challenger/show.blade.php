@extends('layouts.app')

@section('page-title', sprintf('%s | Challenger Profile', $challenger))

@section('meta')
	<meta property="og:title" content="{{ $challenger }}'s Challenger Profile">
	<meta property="og:image" content="{{ asset('images/facebook-preview.jpg') }}">
	<meta property="og:site_name" content="TRAZ Pokémon League">
	<meta property="og:description" content="View {{ $challenger }}'s badges in the {{ $current_season }} of the Team Rocket AZ Pokémon League.">
@stop

@section('content')
	<div class="container" id="challenger-profile">
		<h1 class="subtitled">Challenger</h1>
		<h2>{{ $challenger }}</h2>

		@can('admin')
			<div class="actions">
				<a class="btn btn-default" href="{{ route('admin.challenger.award', $challenger) }}"><i class="fa fa-shield-check"></i> Award Badge</a>
				<a class="btn btn-default" href="{{ route('admin.challenger.edit', $challenger) }}"><i class="fa fa-edit"></i> Edit Profile</a>
				@if ($current_season && !$challenger->isRegistered())
					<a class="btn btn-default" href="{{ route('admin.challenger.register', $challenger) }}"><i class="fa fa-user-plus"></i> Register for {{ $current_season }}</a>
				@endif
			</div>
		@endcan

		<div class="row">
			<div class="col-md-8">

				<h3>Badges: {{ $current_season }}</h3>

				<div class="row badge-list">
					@forelse ($season_badges as $badge)
						<div class="col-xs-4 col-sm-3 equal-height">
							<div class="badge-league">
								<div class="well">

									@can('admin')
										<div
											data-id="{{ $badge->id }}"
											data-name="{{ $badge->name }}"
											class="delete"
											title="Remove this badge"><i class="fa fa-times"></i></div>
									@endcan
									@if ($challenger->type && $badge->pivot->type_id == $challenger->type_id)
										<div class="type-point">
											<i class="{{ $challenger->type->icon }} pkmn-type-color" 
												title="{{ $challenger->type }} Gym Point Earned"></i>
										</div>
									@endif
									<img src="{{ $badge->image_url }}" alt="{{ $badge }}">
								</div>

								<div class="badge-name">
									<i class="gym-point fa fa-medal"></i> {{ $badge->name }}
								</div>
							</div>
						</div>
					@empty
						<div class="col-xs-12">No badges won yet this season!</div>
					@endforelse
				</div>

				<hr>

				<h4>Available Badges for {{ $current_season }}</h4>

				<div class="row badge-list">
					@foreach ($season_badges_inactive as $badge)
						<div class="col-xs-4 col-sm-3 equal-height">
							@can('admin')
								<a class="badge-league inactive" href="{{ route('admin.challenger.award', [
										'challenger' => $challenger, 
										'badge' => $badge
									]) }}">
							@else
								<div class="badge-league inactive">
							@endcan
								<div class="well">
									<img src="{{ $badge->image_url }}" alt="{{ $badge }}" class="equal-height">
								</div>
								<div class="badge-name">{{ $badge->name }}</div>
							@can('admin')
								</a>
							@else
								</div>
							@endcan
						</div>
					@endforeach
				</div>
			</div>
			<div class="col-md-4">
				<div class="challenger-info">
					<div class="since">Challenger Since <strong>{{ $challenger->joined_season }}</strong></div>
						@if ($challenger->type)
							<div class="line">
								<label>Type</label>
								<div class="data">
									<i class="{{ $challenger->type->icon }} pkmn-type-color icon-big" title="{{ $challenger->type }} Type Trainer" aria-hidden="true"></i>
									{{ $challenger->type }} Trainer
								</div>
							</div>
						@endif
						@foreach ($challenger->data as $data)
							<div class="line">
								<label>{{ $data->name }}</label>
								<div class="data">{{ $data }}</div>
							</div>
						@endforeach
						<div class="line">
							<label>Joined</label>
							<div class="data">{{ $challenger->join_date->format('F j, Y') }}</div>
						</div>


						@if (!$challenger->social->isEmpty())
							<div class="social-media">
							@foreach ($challenger->social as $social)
								<a href="{{ $social->url }}" target="_blank"><i class="fab fa-{{ $social->service }}-square"></i></a>
							@endforeach
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- To do: Add a back to list button --}}
@stop

@can('admin')
	@push('scripts')
		<script>
			(function($) {
				function deleteBadge(id) {
					$('body').addClass('load-lock')
					$.ajax({
						url: '{{ route('admin.challenger.badge.delete', ["challenger" => $challenger, "badge" => '_BADGE_ID_']) }}'.replace("_BADGE_ID_", id),
						data: { '_token': Laravel.csrfToken },
						type: 'DELETE',
						success: function (result) {
							if (result.success) {
								location.reload()
							} else {
								$('body').removeClass('load-lock')
								alert(result.message || "Something went wrong removing this badge.")
							}
						},
						error: function (request, msg, error) {
							$('body').removeClass('load-lock')
							alert("Something went wrong removing this badge. " + msg)
						}
					})
				}

				$('.badge-league .delete').click(function(e) {
					var deleteButton = $(this)
					var badgeName = deleteButton.data('name')
					var badgeId = deleteButton.data('id')
					e.preventDefault()
					if (confirm("Are you sure you want to remove the " + badgeName + " badge? ")) {
						deleteBadge(badgeId)
					}
				})
			})(jQuery)
		</script>
	@endpush
@endcan