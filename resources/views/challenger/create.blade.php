@extends('layouts.app')

@section('page-title', 'Register New Challenger')

@section('content')
	<div class="container" id="challenger-profile">
		<h1 class="subtitled">Challengers</h1>
		<h2>New Challenger</h2>

		<div class="row">
			<div class="col-md-8 col-md-push-1 col-lg-6 col-lg-push-2">
				<form action="{{ route('admin.challenger.store') }}" method="post">
					{{ csrf_field() }}

					<div class="form-group">
						<label for="challenger_name">Name</label>
						<input class="form-control" type="text" name="name" id="challenger_name" value="{{ old('name') }}" required>
					</div>

					<div class="form-group">
						<label for="challenger_join_date">Join Date</label>
						<input class="form-control" type="date" name="join_date" 
							id="challenger_join_date" value="{{ old('join_date', date('Y-m-d')) }}" required>
					</div>

					<div class="form-group">
						<label for="challenger_join_season">First participated in</label>
						<select name="joined_season_id" class="form-control" id="challenger_join_season" required>
							@foreach(App\Models\Season::all() as $season)
								<option value="{{ $season->id }}" 
									{{ $season->id == old('joined_season_id', $season->is_current? $season->id : null)? 'selected' : '' }}>
									{{ $season }}
								</option>
							@endforeach
						</select>
					</div>
					<div class="text-right">
						<button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Add New Challenger</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop