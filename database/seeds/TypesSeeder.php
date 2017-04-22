<?php

use Illuminate\Database\Seeder;

use App\Models\Type;

class TypesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$types = [
			'Normal',
			'Fire',
			'Fighting',
			'Water',
			'Flying',
			'Grass',
			'Poison',
			'Electric',
			'Ground',
			'Psychic',
			'Rock',
			'Ice',
			'Bug',
			'Dragon',
			'Ghost',
			'Dark',
			'Steel',
			'Fairy'
		];

		foreach ($types as $type) {
			Type::create(['name' => $type]);
		}
	}
}
