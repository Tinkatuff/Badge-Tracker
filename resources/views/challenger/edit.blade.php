@extends('layouts.app')

@section('page-title', sprintf('%s | Edit Challenger Profile', $challenger))

@section('content')
	<div class="container" id="challenger-profile">
		<h1 class="subtitled">Challengers</h1>
		<h2>Edit {{ $challenger }}</h2>

		<div class="row">
			<div class="col-md-8 col-lg-6">
				<form action="{{ route('admin.challenger.update', $challenger) }}" method="post">
					{{ csrf_field() }}

					<div class="form-group">
						<label for="challenger_name">Name</label>
						<input class="form-control" type="text" name="name" id="challenger_name" value="{{ old('name', $challenger->name) }}" required>
					</div>

					<div class="form-group">
							<label for="trainer_type">Gym Trainer Type</label>
							<select name="type_id" class="form-control" id="trainer_type">
								<option value="">Not a gym trainer</option>
								@foreach ($types as $type)
									<option value="{{ $type->id }}" {{ $type->id == old('type_id', $challenger->type_id)? 'selected' : '' }}>{{ $type }} Gym</option>
								@endforeach
							</select>
						</div>

					<div class="form-group">
						<label for="challenger_join_date">Join Date</label>
						<input class="form-control" 
							type="date" 
							name="join_date" 
							id="challenger_join_date" 
							value="{{ old('join_date', $challenger->join_date? $challenger->join_date->format('Y-m-d') : '') }}" 
							required>
					</div>

					<div class="form-group">
						<label for="challenger_join_season">First participated in</label>
						<select name="joined_season_id" class="form-control" id="challenger_join_season" required>
							@foreach(App\Models\Season::all() as $season)
								<option value="{{ $season->id }}"
									{{ App\selected(old('joined_season_id', $challenger->joined_season_id), $season->id) }}>
									{{ $season }}
								</option>
							@endforeach
						</select>
					</div>
					<div class="text-right">
						<a href="{{ route('challenger.show', $challenger) }}" class="btn btn-default pull-left"><i class="fa fa-times"></i> Cancel changes</a>
						<button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Update Challenger Profile</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop