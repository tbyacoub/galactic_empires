<?php

use Illuminate\Database\Seeder;

class PrivateMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\PrivateMessage::class, 50)->create();
    }
}
