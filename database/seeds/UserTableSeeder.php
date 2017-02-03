<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    private $activatedPlayer;

    private $suspendedPlayer;

    private $premiumPlayer;

    private $admin;

    private $count = 0;
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

        factory(\App\User::class, 50)->create()->each(function ($u){
            switch (($this->count % 3)){
                case 1:
                    $u->attachRole($this->player);
                    break;
                case 2:
                    $u->attachRole($this->player);
                    break;
                case 3:
                    $u->attachRole($this->player);
                    break;
            }

        });

        $adminUser = new \App\User();
        $adminUser->name = 'tbyacoub';
        $adminUser->email = 'tbyacoub@gmail.com';
        $adminUser->password = (bcrypt('password'));
        $adminUser->save();
        $adminUser->attachRole($this->admin);

        $playerUser = new \App\User();
        $playerUser->name = 'test';
        $playerUser->email = 'test@test.com';
        $playerUser->password = bcrypt('password');
        $playerUser->save();
        $playerUser->attachRole($this->player);
    }
}
