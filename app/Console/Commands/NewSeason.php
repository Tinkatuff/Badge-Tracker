<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Season;
use App\Models\Type;
use App\Models\Badge;
use Carbon\Carbon;
use App\Models\Challenger;

class NewSeason extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'season:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $types, $badges, $badgeFiles;
    const DATE_FORMAT = 'n/j/Y';

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
        $nextId = Season::max('id') + 1;
        $this->season = new Season;
        $this->season->name = 'Season ' . $nextId;
        $this->season->start_date = Carbon::today();
        $this->updateSeasonName();
        $this->updateSeasonStartDate();
        $this->updateSeasonIsCurrent();

        $this->refreshBadgeFiles();
        $this->badges = [];
        $this->types = Type::pluck('name', 'id')->toArray();
        foreach ($this->types as $id => $type) {
            unset($this->types[$id]);
            $this->types[sprintf('%02d', $id)] = strtolower($type);
        }
        $this->addBadges();

        $this->showMenu();
    }

    protected function refreshBadgeFiles()
    {
        $this->badgeFiles = array_map('basename', \File::files(public_path() . '/badges'));
        return $this->badgeFiles;
    }

    protected function showMenu()
    {
        $options = [
            'name' => 'Update season name',
            'date' => 'Update season start date',
            'current' => 'Set season current',
            'add badge' => 'Add badges',
            'remove badge' => 'Remove a badge',
            'update badge' => 'Update a badge',
            'save' => 'Finish and save season',
            'discard' => 'Discard changes and quit'
        ];

        $this->showPreview();
        $option = $this->choice('What next?', $options);

        switch ($option) {
            case 'name': $this->updateSeasonName(); $this->showMenu(); break;
            case 'date': $this->updateSeasonStartDate(); $this->showMenu(); break;
            case 'current': $this->updateSeasonIsCurrent(); $this->showMenu(); break;
            case 'add badge': $this->addBadges(); $this->showMenu(); break;
            case 'remove badge': $this->removeBadge(); $this->showMenu(); break;
            case 'update badge': $this->updateBadge($this->selectBadge()); $this->showMenu(); break;
            case 'save': $this->confirmSaveAndQuit(); break;
            case 'discard': $this->discardAndQuit(); break;
        }
    }

    protected function updateSeasonName()
    {
        $this->season->name = $this->ask('Enter season name', $this->season->name);
    }

    protected function updateSeasonStartDate()
    {
        $this->season->start_date = Carbon::parse($this->ask('Enter season start date', $this->season->start_date->format(self::DATE_FORMAT)));
    }

    protected function updateSeasonIsCurrent()
    {
        $this->season->is_current = $this->confirm('Is this the current season?');
    }

    protected function addBadges()
    {
        $stop = 'xx';
        reset($this->types);
        $currentKey = key($this->types);

        do {
            // Select a type
            $typeId = $this->choice('Select a type', $this->types + [$stop => 'Stop adding badges'], $currentKey);

            if ($typeId == $stop) {
                break;
            }

            $typeKey = $this->types[$typeId];

            // Set the next suggestion to be the one after the current selected option
            reset($this->types);
            while($currentKey = key($this->types)) {
                if ($currentKey == $typeId) {
                    next($this->types);
                    unset($this->types[$typeId]); // and also remove this option from the types list
                    $currentKey = key($this->types);
                    break;
                }
                if (next($this->types) === false) {
                    reset($this->types);
                    $currentKey = $stop;
                    break;
                }
            }

            $type = Type::find($typeId);
            $badge = new Badge;
            $badge->name = $type->name . ' Badge';

            $image = $typeKey.'.png';
            if (in_array($image, $this->badgeFiles)) {
                $badge->image = $image;
            }

            $badge->type()->associate($type);
            $this->updateBadge($badge);

            $this->badges[strtolower($typeKey)] = $badge;
        } while (!empty($this->types) && $this->confirm('Add more badges?', true));
    }
    
    protected function selectBadge()
    {
        $badge = $this->choice('Select a badge', $this->badges);
        return $this->badges[$badge];
    }

    protected function removeBadge()
    {
        $cancel = 'xx';
        $badgeType = $this->choice('Remove which badge?', $this->badges + [$cancel => "Cancel"]);
        if ($badgeType == $cancel) {
            return;
        }

        $badge = $this->badges[$badgeType];
        if ($this->confirm("Remove the {$badge->type} type badge from {$this->season}?")) {
            $this->types[sprintf('%02d', $badge->type->id)] = $badge->type;
            unset($this->badges[$badgeType]);
        }
    }

    protected function updateBadge($badge)
    {
        $oldNames = Badge::where('type_id', '=', $badge->type->id)->pluck('name')->toArray();
        $badge->name = $this->anticipate("Enter {$badge->type->name} type badge name", $oldNames, $badge->name);
        $badge->image = $this->choice('Select badge image', $files = $this->refreshBadgeFiles(), array_search($badge->image, $files) ?: null);
        return $badge;
    }

    protected function showPreview()
    {
        $isCurrent = $this->season->is_current? 'Yes' : 'No';
        $this->line("//----------------- {$this->season->name} -----------------//");
        $this->line("  Start date: {$this->season->start_date->format(self::DATE_FORMAT)}");
        $this->line("  Is current: {$isCurrent}");

        $this->line("  Badges: ");
        if (!empty($this->badges)) {
            $this->table(['Name','Type','Image'], array_map(function($badge) {
                return [$badge->name, $badge->type->name, $badge->image];
            }, $this->badges));
        } else {
            $this->error('+--------- No badges ---------+');
        }
    }

    protected function confirmSaveAndQuit()
    {
        $this->info("Please review the current data for this season.");
        $this->showPreview();
        if ($this->confirm("Are you sure this season is ready to be saved?")) {
            $this->saveAndQuit();
        } else {
            $this->showMenu();
        }
    }

    protected function saveAndQuit()
    {
        $this->season->save();
        $this->info("Saving {$this->season}");

        foreach ($this->badges as $badge) {
            $this->season->badges()->save($badge);
            $this->info("> {$badge}");
        }

        if ($this->season->is_current) {
            $this->info("* Setting {$this->season} as current season *");
            $this->season->setCurrent();
        }

        $this->info("Successfully saved everything for {$this->season}!");
        exit(0);
    }

    protected function discardAndQuit()
    {
        if ($this->confirm("Are you sure you want to discard your changes?")) {
            $this->info('Exiting without saving');
        } else {
            $this->showMenu();
        }
    }
}
