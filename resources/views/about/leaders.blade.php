@extends('layouts.app')

@section('page-title', 'Meet Our Gym Leaders')

@section('content')
	<div class="container-fluid">
		<h1 class="text-center">Meet Our Gym Leaders</h1>
		<div class="leader-bios">


			<div class="leader-bio">
				<h2>Ace</h2>
				<h3>An unlucky gambler</h3>

				<img class="img-responsive" src="{{ asset('images/leaders/ace-optimized.jpg') }}" width="200" height="302" alt="Photo of Ace">

				<ul class="list-unstyled">
					<li><strong>Type:</strong> Dark</li>
					<li><strong>Signature Pokemon:</strong> Absol, Alolan Persian</li>
					<li><strong>Lucky Number:</strong> 3</li>
				</ul>
				
				<p style="font-style: italic">Using his skill with numbers, Ace has been helping keep the TRAZ league organized. He is new to the Arizona region, and considers the chance to work with the league one of his few lucky
				breaks. Overcome a game of chance to beat him at his own game and earn the Suit Badge.</p>
			</div>

			<div class="leader-bio">
				<h2>Professor Plum</h2>
				<h3>A professional toxicologist</h3>

				<img class="img-responsive" src="{{ asset('images/leaders/professor-plum-optimized.jpg') }}" width="200" height="302" alt="Photo of Professor Plum">

				<ul class="list-unstyled">
					<li><strong>Type:</strong> Poison</li>
					<li><strong>Signature Pokemon:</strong> Crobat, Amoongus</li>
					<li><strong>Favorite Candy:</strong> Kit Kat bars</li>
				</ul>
				
				<p style="font-style: italic">One of the founders of the TRAZ league. Years of working with toxic chemicals have made him a bit eccentric, but that hasn’t changed his battling skill. Defeat him for the Toxicology Badge, and a grade on your creativity and performance.</p>
			</div>

		</div>
	</div>
@endsection