<?php

use Illuminate\Database\Seeder;

class PlanetSeeder extends Seeder
{

    public $mm;
    public $cm;
    public $er;
    public $fs;
    public $am;
    public $pt;
    public $rs;
    public $al;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->mm = \App\Building::where('name', 'metal_mine')->first();
        $this->cm = \App\Building::where('name', 'crystal_mine')->first();
        $this->er = \App\Building::where('name', 'energy_reactor')->first();
        $this->fs = \App\Building::where('name', 'fleet_shipyard')->first();
        $this->am = \App\Building::where('name', 'anti_air_missile')->first();
        $this->pt = \App\Building::where('name', 'plasma_turret')->first();
        $this->rs = \App\Building::where('name', 'research_station')->first();
        $this->al = \App\Building::where('name', 'alloy_lab')->first();

        factory(\App\SolarSystem::class, 20)->create();

        factory(\App\PlanetType::class, 5)->create();

        $users = \App\User::all();

        foreach($users as $user){
            $user->planets()->saveMany(factory(\App\Planet::class, 2)->make());
            $planets = $user->planets()->get();
            foreach ($planets as $p) {
                $p->buildings()->attach($this->mm, ['current_level' => 1]);
                $p->buildings()->attach($this->cm, ['current_level' => 1]);
                $p->buildings()->attach($this->er, ['current_level' => 1]);
                $p->buildings()->attach($this->fs, ['current_level' => 1]);
                $p->buildings()->attach($this->am, ['current_level' => 1]);
                $p->buildings()->attach($this->pt, ['current_level' => 1]);
                $p->buildings()->attach($this->rs, ['current_level' => 1]);
                $p->buildings()->attach($this->al, ['current_level' => 1]);
            }
        }

        factory(\App\Planet::class, 'unassigned', 25)->create()->each(function ($p){
            $p->buildings()->attach($this->mm, ['current_level' => 1]);
            $p->buildings()->attach($this->cm, ['current_level' => 1]);
            $p->buildings()->attach($this->er, ['current_level' => 1]);
            $p->buildings()->attach($this->fs, ['current_level' => 1]);
            $p->buildings()->attach($this->am, ['current_level' => 1]);
            $p->buildings()->attach($this->pt, ['current_level' => 1]);
            $p->buildings()->attach($this->rs, ['current_level' => 1]);
            $p->buildings()->attach($this->al, ['current_level' => 1]);
        });
    }
}
