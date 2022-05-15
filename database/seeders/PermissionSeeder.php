<?php

namespace Premialabs\Foundation\Seeders;

use Premialabs\Foundation\Permission\gen\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::upsert([
            ['code' => 'auth.login', 'description' => 'Login'],
            ['code' => 'auth.notfound', 'description' => 'Page Not Found'],
            ['code' => 'auth.home', 'description' => 'Home Page'],
            ['code' => 'auth.viewUserSessions', 'description' => 'View user session details'],

            ['code' => 'settings', 'description' => 'Modify Settings'],
            ['code' => 'settings.modifyUsers', 'description' => 'Modify Users in Settings'],
            ['code' => 'settings.changePassword', 'description' => 'Change Password in Settings'],
            ['code' => 'settings.modifyRoles', 'description' => 'Modify Roles in Settings'],
            ['code' => 'settings.modifyUserRoles', 'description' => 'Modify User Roles in Settings'],
            ['code' => 'settings.modifyRolePermissions', 'description' => 'Modify Role Permissions in Settings'],
            ['code' => 'settings.modifySystemParameters', 'description' => 'Modify System Parameters in Settings'],
            ['code' => 'settings.modifyModelsToAudit', 'description' => 'Modify models to be audited in Settings'],
        ], ['code'], ['description']);
    }
}
