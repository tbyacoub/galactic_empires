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
        $this->call(GameObjectsSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(MailSeeder::class);
        $this->call(GlobalRatesSeeder::class);
    }

}
