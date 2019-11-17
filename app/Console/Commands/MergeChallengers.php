<?php

namespace App\Console\Commands;

use App\Models\Challenger;
use App\Models\ChallengerDedupeItem;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use DB;

class MergeChallengers extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'challenger:merge {dupe_challenger_id} {master_challenger_id}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Merges a duplicate challenger into a master challenger.';


	protected $newChallenger, $oldChallenger;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->oldChallenger = Challenger::findOrFail($this->argument('dupe_challenger_id'));
		$this->newChallenger = Challenger::findOrFail($this->argument('master_challenger_id'));

		DB::transaction(function () {
			$this->dedupeRelations();
			$this->oldChallenger->merged_into_challenger_id = $this->newChallenger->id;
			$this->oldChallenger->save();
			$this->newChallenger->current_season_badges = null;
			$this->newChallenger->current_season_type_points = null;
			$this->newChallenger->save();
		});
	}

	protected function dedupeRelations()
	{
		foreach ($this->oldChallenger->getDedupeRelations() as $rel) {
			$related = $this->oldChallenger->{$rel};

			if (is_null($related)) {
				continue;
			}

			if ($related instanceOf Collection) {
				foreach($related as $item) {
					$this->dedupeItem($item);
				}
			} else {
				$this->dedupeItem($related);
			}
		}
	}

	protected function dedupeItem($item)
	{
		// Use the pivot if one exists
		if ($item->pivot) {
			$item = $item->pivot;
		}

		$item->challenger()->associate($this->newChallenger);
		$item->save();

		$dedupeItem = new ChallengerDedupeItem;
		$dedupeItem->item()->associate($item);
		$dedupeItem->oldChallenger()->associate($this->oldChallenger);
		$dedupeItem->newChallenger()->associate($this->newChallenger);
		$dedupeItem->save();
		return $dedupeItem;
	}
}
