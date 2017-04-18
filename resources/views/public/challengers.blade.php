@extends('layouts.app')

@section('page-title', 'Challenger Directory')

@section('content')
	<div class="container" id="challengers">
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-sm-6">
						<h1>Challenger Directory</h1>
					</div>
					<div class="col-sm-6">
						<form class="search">
							<div class="input-group">
								<input type="text" name="search" class="form-control" placeholder="Filter Challengers">
								<span class="input-group-btn">
									<button class="btn btn-default" type="submit">
										<i class="fa fa-search" aria-hidden="true" aria-title="Search"></i>
									</button>
								</span>
							</div>
						</form>
					</div>
				</div>

				<ol class="challenger-list">
					<li class="challenger">
						<a href="#">
							<h2 class="name">Agent Whatever</h2>
							<div class="stats">
								<span class="badges">
									<i class="fa fa-shield" aria-hidden="true" title="5 of 18 Badges Won"></i>
									5 / 18
								</span>
								<span class="since">
									<i class="fa fa-calendar" aria-hidden="true" title="Challenger Since Season 1"></i>
									Season 1
								</span>
							</div>
						</a>
					</li>
					<li class="challenger">
						<a href="#">
							<h2 class="name">Not You</h2>
							<div class="stats">
								<span class="badges">
									<i class="fa fa-shield" aria-hidden="true" title="5 of 18 Badges Won"></i>
									1 / 18
								</span>
								<span class="since">
									<i class="fa fa-calendar" aria-hidden="true" title="Challenger Since Season 1"></i>
									Season 2
								</span>
							</div>
						</a>
					</li>
					<li class="challenger">
						<a href="#">
							<h2 class="name">Your Mother</h2>
							<div class="stats">
								<span class="badges">
									<i class="fa fa-shield" aria-hidden="true" title="5 of 18 Badges Won"></i>
									0 / 18
								</span>
								<span class="since">
									<i class="fa fa-calendar" aria-hidden="true" title="Challenger Since Season 1"></i>
									Season 0
								</span>
							</div>
						</a>
					</li
				</ol>
			</div>
			<div class="col-md-4 hidden-sm hidden-xs">
				Sidebar
			</div>
		</div>
	</div>
@endsection