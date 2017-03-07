<?php

namespace App\Jobs;

use App\Building;
use App\Events\EmailSentEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class UpgradeBuilding implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $building_id;

    /**
     * Create a new job instance.
     *
     * @param $id
     */
    public function __construct($id)
    {
        $this->building_id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Increment building level on database.
        DB::table('building_planet')
            ->where('id', strval($this->building_id))
            ->increment('current_level');



    }
}
