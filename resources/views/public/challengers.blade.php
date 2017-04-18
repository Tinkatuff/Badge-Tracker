@extends('layouts.app')

@section('page-title', 'Challenger Directory')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1>Challenger Directory</h1>

				<ol class="challenger-list">
					<li class="challenger">
						<a href="#">
							<h2 class="name">Agent Whatever</h2>
							<div class="stats">
								<span class="badges">
									<i class="fa fa-shield" aria-hidden="true" title="5 of 18 Badges Won"></i>
									5 / 18
								</span>
								<span class="since hidden-xs">
									<i class="fa fa-calendar" aria-hidden="true" title="Challenger Since Season 1"></i>
									Season 1
								</span>
							</div>
						</a>
					</li>
				</ol>
			</div>
			<div class="col-md-4 hidden-sm hidden-xs">
				Sidebar
			</div>
		</div>
	</div>
@endsection