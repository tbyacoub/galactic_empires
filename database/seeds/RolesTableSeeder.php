<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'role player',
            'display_name' => 'display name',
            'description' => 'Description: player',
        ]);

        DB::table('roles')->insert([
            'name' => 'role admin',
            'display_name' => 'display name',
            'description' => 'Description: admin',
        ]);
    }
}
