@extends('layouts.app')

@section('page-title', 'About The League')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10">
				<h1>League Rules</h1>
				<div style="color: #999">
					<a href="#general-rules">General&nbsp;Rules</a>&ensp;&bull;&ensp;{{-- 
					--}}<a href="#gym-trainer-rules">Gym&nbsp;Trainer&nbsp;Rules</a>&ensp;&bull;&ensp;{{--
					--}}<a href="#tournament-rules">Challengers'&nbsp;Tournament&nbsp;Rules</a>
				</div>

				<h2 id="general-rules">General Rules</h2>

				<h3>Teams and battle format</h3>
				<p>Battles are done with teams of 6 pokemon. The challenged gym leader will determine the battle format (e.g. Single Battle, Double Battle, etc)</p>
				
				<h3>Legality</h3>
				<p>All pokemon must have legally available moves, items, and abilities available through normal game mechanics. As examples, Flareon can not learn Fly, the Fire Gem is not available in-game, and Magikarp can not have the Wonder Guard ability.</p>
				
				<h3>Pokemon clause</h3>
				<p>No repeat pokemon. Alolan forms are considered different than their non-alolan counterparts.</p>
				
				<h3>Item clause</h3>
				<p>Multiple pokemon cannot be holding the same exact item. Two pokemon with leftovers is not acceptable, but two with different types of z-crystals is acceptable.</p>
				
				<h3>Sleep clause</h3>
				<p>You can only put one enemy pokemon to sleep at a time, even if one of those sleeping pokemon has been switched out.</p>
				
				<h3>No 1-Hit KO moves</h3>
				<p>You cannot have Guillotine, Fissure, Sheer Cold, or Horn Drill.</p>
				
				<h3>Evasion clause</h3>
				<p>No direct evasion increasing moves can be used, which only applies to Minimize and Double Team. Indirect effects are allowed, such as certain abilities such as Moody, items such as bright powder, or the random chance of Acupuncture.</p>
				
				<h3>Banned Pokemon</h3>
				<p>Pokemon that cannot be used in the Super Battle Tree cannot be used. They are as follows:</p>
		
				@php
					$unallowed = [
						'150' => 'Mewtwo',
						'151' => 'Mew',
						'249' => 'Lugia',
						'250' => 'Ho-oh',
						'251' => 'Celebi',
						'382' => 'Kyogre',
						'383' => 'Groudon',
						'384' => 'Rayquaza',
						'385' => 'Jirachi',
						'386' => 'Deoxys',
						'483' => 'Dialga',
						'484' => 'Palkia',
						'487' => 'Giratina',
						'489' => 'Phione',
						'490' => 'Manaphy',
						'491' => 'Darkrai',
						'492' => 'Shaymin',
						'493' => 'Arceus',
						'494' => 'Victini',
						'643' => 'Reshiram',
						'644' => 'Zekrom',
						'646' => 'Kyurem',
						'647' => 'Keldeo',
						'648' => 'Meloetta',
						'649' => 'Genesect',
						'716' => 'Xerneas',
						'717' => 'Yveltal',
						'718' => 'Zygarde',
						'719' => 'Diancie',
						'720' => 'Hoopa',
						'721' => 'Volcanion',
						'789' => 'Cosmog',
						'790' => 'Cosmoem',
						'791' => 'Solgaleo',
						'792' => 'Lunala',
						'800' => 'Necrozma',
						'801' => 'Magearna',
						'802' => 'Marshadow',
						'807' => 'Zeraora'
					]
				@endphp
		
				<div class="pokemon-grid">
					@foreach ($unallowed as $num => $name)
						<div class="pokemon">
							<div>{{ $name }}</div>
							<img src="{{ asset(sprintf('images/pokemon/%03d.png', $num)) }}" alt="{{ $name }} sprite">
						</div>
					@endforeach
				</div>

				@push('styles')
					<style type="text/css">
						.pokemon-grid {
							font-size: 0;
						}

						.pokemon-grid .pokemon {
							display: inline-block;
							width: 90px;
							padding: 10px;
							text-align: center;
							border: 1px solid #eee;
							height: 100px;
							vertical-align: top;
							margin: 0.5em 0.5em 0 0;
							font-size: 12px;
						}

						.pokemon-grid .pokemon img {
							max-width: 100%;
							max-height: 60px;
						}
					</style>
				@endpush
		
				<hr>
		
				<h2 id="gym-trainer-rules">Gym Trainer Rules</h2>
				<p>A challenger may decide to represent a gym leader or type and earn points for that type through the tournament. All general rules still apply to these matches, but with the following caveats:</p>
				<h3>Typing</h3>
				<p>All pokemon used must be of your gym's typing as it enters the field, without the use of an item.</p>
				<h3>Megas</h3>
				<p>All pokemon used must be of your gym's typing before mega evolving.</p>
				<h3>Z-Crystals</h3>
				<p>Initially, only the z-crystal you can use is that of your type. As you earn gym points, you unlock the z-crystals of the Gym Leaders you have defeated.</p>
				<h3>Signature Z-Crystals</h3>
				<p>An exception to the above rule is when a pokemon in use with two types has a signature z-move. As examples, a ghost-type Gym Trainer can use a Mimikyu with Mimikium-Z, even though Let's Snuggle Forever is a fairy-type move. A fire-type Gym Trainer can use an Incineroar with Incinium-Z, even though Malicious Moonsault is a dark-type move. Ditto and Smeargle can only use such Z-Crystals if the Gym Leader of the crystal's type has been defeated.</p>
				<h3>Points and Badges</h3>
				<p>You can use a Gym Trainer team that follows the above rules to earn a badge and a gym point in one battle; or you can use a different team to earn the badge but not the gym point.</p>
		
				<hr>
		
				<h2 id="tournament-rules">Challengers' Tournament Rules</h2>
				<p>For the finale of a season, a tournament between league challengers take place. During this tournament, all General Rules must be followed. The tournament is single-elimination, 6 vs 6 single battles. Placement within the bracket is determined by number of badges earned, and at least one badge is required to enter. Each challenger must use a single team through the entire tournament.</p>
		
			</div>
		</div>
	</div>
@endsection