@extends('layouts.app')

@section('page-title', 'Meet Our Gym Leaders')

@section('content')
	<div class="container-fluid">
		<h1 class="text-center">Meet Our Gym Leaders</h1>
		<div class="leader-bios">


			<div class="leader-bio">
				<h2>Ace</h2>
				<h3>An unlucky gambler</h3>

				<img class="img-responsive" src="{{ asset('images/leaders/ace.jpg') }}" width="200" alt="Photo of Ace">

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

				<img class="img-responsive" src="{{ asset('images/leaders/professor-plum.jpg') }}" width="200" alt="Photo of Professor Plum">
				
				<ul class="list-unstyled">
					<li><strong>Type:</strong> Poison</li>
					<li><strong>Signature Pokemon:</strong> Crobat, Amoongus</li>
					<li><strong>Favorite Candy:</strong> Kit Kat bars</li>
				</ul>
				
				<p>One of the founders of the TRAZ league. Years of working with toxic chemicals have made him a bit eccentric, but that hasn’t changed his battling skill. Defeat him for the Toxicology Badge, and a grade on your creativity and performance.</p>
			</div>

			<div class="leader-bio">
				<h2>Kayn Coldsteel</h2>
				<h3>An iron-hearted vigilante</h3>

				<img class="img-responsive" src="{{ asset('images/leaders/kayn-coldsteel.jpg') }}" width="200" alt="Photo of Kayn Coldsteel">

				<ul class="list-unstyled">
					<li><strong>Type:</strong> Steel</li>
					<li><strong>Signature Pokemon:</strong> Aegislash, Bisharp</li>
					<li><strong>Favorite Band:</strong> Three Days Grace</li>
				</ul>
				
				<p>Everyone loves a good anti-hero, and Kayn is about as edgy and brooding as they come. He constantly seeks out strong opponents to battle for the chance to improve his skills as a trainer. Battle his team of titanic Pokémon and see if you have what it takes to earn the Edge Badge.</p>
			</div>


			<div class="leader-bio">
				<h2>Priest Solbrann</h2>
				<h3>A fiery fanatic</h3>

				<img class="img-responsive" src="{{ asset('images/leaders/priest-solbrann.jpg') }}" width="200" alt="Photo of Priest Solbrann">

				<ul class="list-unstyled">
					<li><strong>Type:</strong> Fire</li>
					<li><strong>Signature Pokemon:</strong> Torkoal, Volcarona</li>
					<li><strong>Preferred Light Source:</strong> The Sun</li>
				</ul>
				
				<p>Priest Solbrann has come from a faraway region to spread the light of the Sun. He spent a good portion of his youth staring at it, without being rendered blind to its image. After learning different ways that fire can burn, perhaps you can stand a chance at earning the Solar Badge.</p>
			</div>
			
			
			<div class="leader-bio">
				<h2>Joe Jitsu</h2>
				<h3>A fighting game enthusiast</h3>

				<img class="img-responsive" src="{{ asset('images/leaders/joe-jitsu.jpg') }}" width="200" alt="Photo of Kayn Coldsteel">

				<ul class="list-unstyled">
					<li><strong>Type:</strong> Fighting</li>
					<li><strong>Signature Pokemon:</strong> Lucario, Scrafty</li>
					<li><strong> Assist Style:</strong> Direct Tilt-Up</li>
				</ul>
				
				<p>Raised in the arcade, Joe Jitsu brings his unique gaming skills to his Pokémon battling style. His competitive nature suits him well as a gym leader, even while he’s calling out command inputs instead of moves. If you think you can beat his Shoryuken you’ll earn yourself a Scuffle Badge.
				</p>
			</div>


			<div class="leader-bio">
				<h2>Dagor Bragollach</h2>
				<h3>A draconian capitalist</h3>

				<img class="img-responsive" src="{{ asset('images/leaders/dagor-bragollach.jpg') }}" width="300" alt="Photo of Priest Solbrann">

				<ul class="list-unstyled">
					<li><strong>Type:</strong> Dragon</li>
					<li><strong>Signature Pokemon:</strong> Salamence, Dragonite</li>
					<li><strong>Favorite Thing:</strong> Money</li>
				</ul>
				
				<p>Dagor is a successful entrepreneur, who decided that investing in a Pokemon league is a sound business decision. Instead of only fighting against him, you’ll need to also fight two of his allies or—worse—two of your friends in a Battle Royal. Prove your greed is the strongest to claim the Avarice Badge.</p>
			</div>

			@php
				$previews = [
					"Huh... We don't have any info on this gym leader yet. I suggest you check back later.",
					"What... Whคt... 山├┤丹丁 . 丹尺モ . 丫〇긴 . D〇工仈夕¿¿¿",
					"`▄´ (()) █▄█ . ▄█▀ ╠╣ (()) █▄█ █▄ █)) █\█ '▀█▀ . █З █▓ . ╠╣ █▓ █▀▄ █▓",
					"[̲̅e̲̅][̲̅r̲̅][̲̅r̲̅][̲̅o̲̅][̲̅r̲̅] fetching ⓜⓘⓢⓢⓘⓝⓖⓝⓞ",
					"... Wow, sorry about that. I'm back! Okay. Check back later and we'll have more info for you."
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
