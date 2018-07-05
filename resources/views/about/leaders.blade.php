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
				
				<p>Using his skill with numbers, Ace has been helping keep the TRAZ league organized. He is new to the Arizona region, and considers the chance to work with the league one of his few lucky
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
				
				<p>One of the founders of the TRAZ league. Years of working with toxic chemicals have made him a bit eccentric, but that hasn’t changed his battling skill. Defeat him for the Toxicology Badge, and a grade on your creativity and performance.</p>
			</div>


			@php
				$previews = [
					"Huh... We don't have any info on this gym leader yet. I suggest you check back later.",
					"I'm not kidding. We don't know more yet. These guys (and gals  ... and... whatever else they may be) are elusive!",
					"I hope you're not still scrolling down hoping to learn more.",
					"Umm...",
					"... &hellip; ..... .............. &hellip;",
					"What... Whคt... 山├┤丹丁 . 丹尺モ . 丫〇긴 . D〇工仈夕¿¿¿",
					"`▄´ (()) █▄█ . ▄█▀ ╠╣ (()) █▄█ █▄ █)) █\█ '▀█▀ . █З █▓ . ╠╣ █▓ █▀▄ █▓",
					"[̲̅e̲̅][̲̅r̲̅][̲̅r̲̅][̲̅o̲̅][̲̅r̲̅] fetching ⓜⓘⓢⓢⓘⓝⓖⓝⓞ",
					"... Wow, sorry about that, I'm back! Okay. Check back later and we'll have more info for you."
				];
			@endphp
			@foreach ($previews as $preview)
				<div class="leader-bio unidentified">
					<h2>???</h2>
					<h3>Unidentified Gym Leader</h3>
					<img class="img-responsive" src="{{ asset('images/leaders/missingno.png') }}" alt="???">
					<p>{{ $preview }}</p>
				</div>
			@endforeach

		</div>
	</div>
@endsection