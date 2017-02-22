<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EntrustSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(BuildingPrototypesSeeder::class);
        $this->call(ResourceBuildingSeeder::class);
        $this->call(PlanetSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(MailSeeder::class);
    }



}
