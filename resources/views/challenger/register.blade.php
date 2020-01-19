@extends('layouts.app')

@section('page-title', sprintf('%s | Edit Challenger Profile', $challenger))

@section('content')
	<div class="container" id="challenger-profile">
		<h1 class="subtitled">Challengers</h1>
		<h2>Regester {{ $challenger }} for {{ $current_season }}</h2>
		<p>Registering a challenger will display them on the front page even if they haven't won any badges yet this season.</p>

		<div class="row">
			<div class="col-md-8 col-lg-6">
				<form action="{{ route('admin.challenger.register.submit', $challenger) }}" method="post">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="trainer_type">Gym Trainer Type</label>
						<select name="type_id" class="form-control" id="trainer_type">
							<option value="">Not a gym trainer</option>
							@foreach ($types as $type)
								<option value="{{ $type->id }}" {{ App\selected(old('type_id', $challenger->type_id), $type->id) }}>{{ $type }} Gym</option>
							@endforeach
						</select>
					</div>

					<div class="text-right">
						<a href="{{ route('challenger.show', $challenger) }}" class="btn btn-default pull-left"><i class="fa fa-times"></i> Cancel Registration</a>
						<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&ensp; Confirm Registration for {{ $current_season }}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop