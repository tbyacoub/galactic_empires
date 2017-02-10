<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    private $activatedPlayer;

    private $suspendedPlayer;

    private $premiumPlayer;

    private $admin;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->admin = \App\Role::where('name', 'admin')->get()[0];
        $this->activatedPlayer = \App\Role::where('name', 'player')->get()[0];
        $this->suspendedPlayer = \App\Role::where('name', 'premium-player')->get()[0];
        $this->premiumPlayer = \App\Role::where('name', 'suspended-player')->get()[0];

        factory(\App\User::class, 5)->create()->each(function ($u){
            $u->attachRole($this->admin);
        });

        factory(\App\User::class, 50)->create()->each(function ($u){
            $u->attachRole($this->activatedPlayer);
        });

        factory(\App\User::class, 5)->create()->each(function ($u){
            $u->attachRole($this->suspendedPlayer);
        });

        factory(\App\User::class, 10)->create()->each(function ($u){
            $u->attachRole($this->premiumPlayer);
        });

        $adminUser = new \App\User();
        $adminUser->name = 'admin';
        $adminUser->email = 'admin@gmail.com';
        $adminUser->save();
        $adminUser->attachRole($this->admin);
    }
}
