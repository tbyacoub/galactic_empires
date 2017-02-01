<?php

use Illuminate\Database\Seeder;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = $this->adminRole();
        $player = $this->playerRole();
        $vpl = $this->viewPlayerList();
        $vgs = $this->viewGameSettings();
        $pn = $this->pushNotifications();
        $this->attachPermission($admin, $vpl);
        $this->attachPermission($admin, $vgs);
        $this->attachPermission($admin, $pn);

    }

    private function adminRole()
    {
        $admin = new \App\Role();
        $admin->name = 'admin';
        $admin->display_name = 'Administrator';
        $admin->description  = 'User is allowed to manage and edit other users, and game settings';
        $admin->save();
        return $admin;
    }

    private function playerRole()
    {
        $player = new \App\Role();
        $player->name = 'player';
        $player->display_name = 'Player';
        $player->description  = 'User is allowed to manage and edit his own settings';
        $player->save();
        return $player;
    }

    private function viewPlayerList()
    {
        $viewPlayersList = new \App\Permission();
        $viewPlayersList->name = 'view-players-list';
        $viewPlayersList->display_name = 'View Players List';
        $viewPlayersList->description = 'User is allowed to view all player registerd in game';
        $viewPlayersList->save();
        return $viewPlayersList;
    }

    private function viewGameSettings()
    {
        $viewGameSettings = new \App\Permission();
        $viewGameSettings->name = 'view-game-settings';
        $viewGameSettings->display_name = 'View Game Settings';
        $viewGameSettings->description = 'User is allowed to view and change global game settings';
        $viewGameSettings->save();
        return $viewGameSettings;
    }

    private function pushNotifications()
    {
        $pushNotifications = new \App\Permission();
        $pushNotifications->name = 'push-notification';
        $pushNotifications->display_name = 'Push Notifications';
        $pushNotifications->description = 'User is allowed to push notification to all registerd users';
        $pushNotifications->save();
        return $pushNotifications;
    }

    private function attachPermission(\App\Role $role, \App\Permission $permission)
    {
        $role->attachPermission($permission);
    }

}
