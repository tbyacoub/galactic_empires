<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Role::where('name', 'admin')->get()[0];

        factory(\App\User::class, 50)->create()->each(function ($u){
            $player = \App\Role::where('name', 'player')->get()[0];
            $u->attachRole($player);
        });

        $adminUser = new \App\User();
        $adminUser->name = 'tbyacoub';
        $adminUser->email = 'tbyacoub@gmail.com';
        $adminUser->password = (bcrypt('password'));
        $adminUser->save();
        $adminUser->attachRole($admin);
    }
}
