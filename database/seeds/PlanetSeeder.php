<?php

use Illuminate\Database\Seeder;

class PlanetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\SolarSystem::class, 20)->create();
        factory(\App\PlanetType::class, 5)->create();

        factory(\App\Planet::class, 100)->create()->each(function ($p){

            // Create a single Building of every Building Prototype in the DB on every planet.
            $prototypes = DB::table('building_prototypes')->get()->toArray();

            foreach ($prototypes as $prototype){

                $p->buildings()->save(factory(App\Building::class)->create([
                    'building_prototype_id' => $prototype->id,
                    'planet_id' => $p->id,
                ]));
            }
        });

        factory(\App\Planet::class, 100)->create();
        factory(\App\Planet::class, 'unassigned', 25)->create();
    }
}
