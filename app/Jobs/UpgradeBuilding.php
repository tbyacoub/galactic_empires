<?php

namespace App\Jobs;

use App\Events\BuildingHasUpgradedEvent;
use App\Events\NotificationReceivedEvent;
use App\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpgradeBuilding implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $building;
    private $user_id;


    /**
     * Create a new job instance.
     *
     * @param $building
     * @param $user_id
     * @internal param $id
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
        $this->building->setProduct();
        event(new BuildingHasUpgradedEvent($this->user_id));
        $this->createNotification();
        event(new NotificationReceivedEvent($this->user_id));
    }

    private function createNotification(){
        $notification = new Notification();
        $notification->subject = "Building upgraded";
        $notification->content = $this->building->description()->first()->display_name .
            " has successfully upgraded to level " . ($this->building->current_level + 1);
        $notification->read = false;
        $notification->user()->associate($this->user_id);
        $notification->save();
    }
}
