<li class="challenger">
	<a href="{{ route('challenger.show', $challenger) }}">
		<h2 class="name">{{ $challenger->name }}</h2>
		@if ($active)
			<div class="stats">
				<span class="badges">
					<i class="fa fa-shield-alt" aria-hidden="true" title="{{ $challenger->current_season_badges }} of {{ $season_badges }} Badges Won"></i>
					{{ $challenger->current_season_badges }} <span class="badges-total">/ {{ $season_badges }}</span>
				</span>
				@if ($challenger->type)
					<span class="trainer-type" title="{{ $challenger->type }} Type Trainer">
						<i class="{{ $challenger->type->icon  }} pkmn-type-color" aria-hidden="true"></i>
						<span class="trainer-type-points">{{ $challenger->current_season_type_points}}</span>
					</span>
				@endif
			</div>
		@else
			<span class="stats"><em>not registered</em></span>
		@endif
	</a>
</li>