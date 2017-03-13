<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class UpgradeBuilding implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $building;
    private $user_id;

    /**
     * Create a new job instance.
     *
     * @param $id
     */
    public function __construct($building, $user_id)
    {
        $this->building = $building;
        $this->user_id = $user_id;
    }

    /**
     * Upgrades building and dispatchs a BuildingHasUpgradedEvent.
     *
     * @return void
     */
    public function handle()
    {
        $this->building->setUpgrading(false);
        $this->building->incrementLevel();
        event(new \App\Events\BuildingHasUpgradedEvent($this->user_id));
    }
}
