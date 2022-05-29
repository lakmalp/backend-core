<?php

namespace Premialabs\Seeders;

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
            ['_seq' => 100000, 'code' => 'auth.login', 'description' => 'Login'],
            ['_seq' => 100100, 'code' => 'auth.notfound', 'description' => 'Page Not Found'],
            ['_seq' => 100200, 'code' => 'auth.home', 'description' => 'Home Page'],
            ['_seq' => 100300, 'code' => 'auth.viewUserSessions', 'description' => 'View user session details'],
            ['_seq' => 100400, 'code' => 'settings', 'description' => 'Modify Settings'],
            ['_seq' => 100500, 'code' => 'settings.modifyUsers', 'description' => 'Modify Users in Settings'],
            ['_seq' => 100600, 'code' => 'settings.changePassword', 'description' => 'Change Password in Settings'],
            ['_seq' => 100700, 'code' => 'settings.modifyRoles', 'description' => 'Modify Roles in Settings'],
            ['_seq' => 100800, 'code' => 'settings.modifyUserRoles', 'description' => 'Modify User Roles in Settings'],
            ['_seq' => 100900, 'code' => 'settings.modifyRolePermissions', 'description' => 'Modify Role Permissions in Settings'],
            ['_seq' => 101000, 'code' => 'settings.modifySystemParameters', 'description' => 'Modify System Parameters in Settings'],
            ['_seq' => 101100, 'code' => 'settings.modifyModelsToAudit', 'description' => 'Modify models to be audited in Settings'],
        ], ['code'], ['description']);
    }
}
