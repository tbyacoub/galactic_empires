<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
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

        $users = \App\User::all();
        $count = 0;

        foreach ($users as $u) {
            if($count < 5) {
                $u->attachRole($this->admin);
                $count++;
            } else if ($count < 6) {
                $u->attachRole($this->premiumPlayer);
                $count++;
            } else if ($count < 8) {
                $u->attachRole($this->suspendedPlayer);
                $count++;
            } else {
                $u->attachRole($this->activatedPlayer);
            }
        }

        $adminUser = new \App\User();
        $adminUser->name = 'admin';
        $adminUser->email = 'admin@gmail.com';
        $adminUser->password = bcrypt('password');
        $adminUser->planets(\App\Planet::where('user_id', -1)->inRandomOrder()->first());
        $adminUser->save();
        $adminUser->attachRole($this->admin);
    }
}
