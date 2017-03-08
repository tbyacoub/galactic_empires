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

    private $building_id;
    private $user_id;

    /**
     * Create a new job instance.
     *
     * @param $id
     */
    public function __construct($building_id, $user_id)
    {
        $this->building_id = $building_id;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::table('building_planet')
            ->where('id', strval($this->building_id))
            ->update(['is_upgrading' => false]);

        // Increment building level on database.
        DB::table('building_planet')
            ->where('id', strval($this->building_id))
            ->increment('current_level');

        event(new \App\Events\BuildingHasUpgradedEvent($this->user_id));
    }
}
