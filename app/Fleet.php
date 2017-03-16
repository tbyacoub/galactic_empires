<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    
    public function planet()
    {
    	return $this->belongsTo('App\Planet');
    }

    public function description()
    {
    	return $this->belongsTo('App\Description');
    }

    public function newFighter(Planet $planet)
    {
    	$fleet = new App\Fleet();
    	$fleet->planet_id = $planet->id;
    	$fleet->type = 'fighter';
    	$fleet->health = 100;
    	$fleet->speed = 55;
    	$fleet->attack = 30;
    	$fleet->defence = 20;
    	$fleet->multipliers = [
    		'Fighter' => 2.0,
    		'Bomber' => 2.0,
    		'Corvette' => 0.5,
    		'Frigate' => 0.5,
    		'Destroyer' => 0.5,
    	];
    }
//----------------------------------------------------------------------
      public function newBomber(Planet $planet)
    {
    	$fleet = new App\Fleet();
    	$fleet->planet_id = $planet->id;
    	$fleet->type = 'bomber';
    	$fleet->health = 200;
    	$fleet->speed = 35;
    	$fleet->attack = 55;
    	$fleet->defence = 70;
    	$fleet->multipliers = [
    		'Fighter' => 0.5,
    		'Bomber' => 1.0,
    		'Corvette' => 0.5,
    		'Frigate' => 2.0,
    		'Destroyer' => 2.0,
    	];
    }

      public function newCorvette(Planet $planet)
    {
    	$fleet = new App\Fleet();
    	$fleet->planet_id = $planet->id;
    	$fleet->type = 'corvette';
    	$fleet->health = 80;
    	$fleet->speed = 100;
    	$fleet->attack = 40;
    	$fleet->defence = 20;
    	$fleet->multipliers = [
    		'Fighter' => 2.0,
    		'Bomber' => 1.0,
    		'Corvette' => 1.0,
    		'Frigate' => 0.5,
    		'Destroyer' => 2.0,
    	];
    }

      public function newFrigate(Planet $planet)
    {
    	$fleet = new App\Fleet();
    	$fleet->planet_id = $planet->id;
    	$fleet->type = 'frigate';
    	$fleet->health = 325;
    	$fleet->speed = 40;
    	$fleet->attack = 70;
    	$fleet->defence = 70;
    	$fleet->multipliers = [
    		'Fighter' => 2.0,
    		'Bomber' => 0.5,
    		'Corvette' => 1.0,
    		'Frigate' => 1.0,
    		'Destroyer' => 0.5,
    	];
    }

      public function newDestroyer(Planet $planet)
    {
    	$fleet = new App\Fleet();
    	$fleet->planet_id = $planet->id;
    	$fleet->type = 'destroyer';
    	$fleet->health = 400;
    	$fleet->speed = 35;
    	$fleet->attack = 100;
    	$fleet->defence = 90;
    	$fleet->multipliers = [
    		'Fighter' => 0.5,
    		'Bomber' => 2.0,
    		'Corvette' => 0.5,
    		'Frigate' => 2.0,
    		'Destroyer' => 2.0,
    	];
    }
}
