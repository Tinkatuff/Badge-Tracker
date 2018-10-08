@extends('layouts.app')

@section('page-title', sprintf('%s | Edit Challenger Profile', $challenger))

@section('content')
	<div class="container" id="challenger-profile">
		<h1 class="subtitled">Challengers</h1>
		<h2>Award badge to {{ $challenger }}</h2>
		<div class="row">
			<div class="col-md-8 col-lg-6">
					@if ($challenger->eligibleBadges()->isEmpty())
						<p>This challenger already has all of the badges for this season!</p>
					@else
					<form action="{{ route('admin.challenger.submitAward', $challenger) }}" method="post">
						{{ csrf_field() }}

						<div class="form-group">
							<label for="awarded_badge_id">Badge</label>
							<select name="badge_id" class="form-control" id="awarded_badge_id" required>
								@foreach($challenger->eligibleBadges() as $badge)
									<option value="{{ $badge->id }}">{{ $badge }} ({{ $badge->type }})</option>
								@endforeach
							</select>
						</div>

						@if ($challenger->type)
							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="type_id" value="{{ $challenger->type->id }}">
										This badge was won for the {{ $challenger->type }} gym.
									</label>
								</div>
							</div>
						@endif

						<div class="text-right">
							<a href="{{ route('challenger.show', $challenger) }}" class="btn btn-default"><i class="fa fa-x"></i> Cancel</a>
							<button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Award Badge</button>
						</div>
					</form>
					@endif
			</div>
		</div>
	</div>
@stop