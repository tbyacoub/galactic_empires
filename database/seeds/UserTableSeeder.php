<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    private $player;

    private $admin;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->admin = \App\Role::where('name', 'admin')->get()[0];
        $this->player = \App\Role::where('name', 'player')->get()[0];

        factory(\App\User::class, 50)->create()->each(function ($u){
//            $player = \App\Role::where('name', 'player')->get()[0];
            $u->attachRole($this->player);
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
