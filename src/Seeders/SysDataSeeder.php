<?php

namespace Premialabs\Seeders;

use Premialabs\Foundation\SystemParameter;
use Premialabs\Foundation\Permission\gen\Permission;
use Illuminate\Database\Seeder;
use Premialabs\Foundation\Role\gen\Role;
use Premialabs\Foundation\RolePermission\gen\RolePermission;
use Premialabs\Foundation\UserRole\gen\UserRole;

class SysDataSeeder extends Seeder
{
    private function _addPermissionToSysAdminRole($_seq, $code, $description, $sys_role_id)
    {
        $perm = Permission::insert(['_seq' => $_seq, 'code' => $code, 'description' => $description]);

        RolePermission::insert([
            'permission_id' => $perm->id,
            'role_id' => $sys_role_id
        ]);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sys_admin_user = User::insert([
            'name' => 'Sys Admin',
            'email' => 'sys@premialabs.com',
            'password' => bcrypt('pwd')
        ]);

        $sys_admin_role = Role::insert([
            '_seq' => 100000,
            'code' => 'SYS_ADMIN',
            'description' => 'Sys Admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $this->_addPermissionToSysAdminRole(100000, 'auth.login', 'Login', $sys_admin_role->id);
        $this->_addPermissionToSysAdminRole(100100, 'auth.notfound', 'Page Not Found', $sys_admin_role->id);
        $this->_addPermissionToSysAdminRole(100200, 'auth.home', 'Home Page', $sys_admin_role->id);
        $this->_addPermissionToSysAdminRole(100300, 'auth.viewUserSessions', 'View user session details', $sys_admin_role->id);
        $this->_addPermissionToSysAdminRole(100400, 'settings', 'Modify Settings', $sys_admin_role->id);
        $this->_addPermissionToSysAdminRole(100500, 'settings.modifyUsers', 'Settings > Modify Users', $sys_admin_role->id);
        $this->_addPermissionToSysAdminRole(100600, 'settings.changePassword', 'Settings > Change Password', $sys_admin_role->id);
        $this->_addPermissionToSysAdminRole(100700, 'settings.modifyRoles', 'Settings > Modify Roles', $sys_admin_role->id);
        $this->_addPermissionToSysAdminRole(100800, 'settings.modifyUserRoles', 'Settings > Modify User Roles', $sys_admin_role->id);
        $this->_addPermissionToSysAdminRole(100900, 'settings.modifyRolePermissions', 'Settings > Modify Role Permissions', $sys_admin_role->id);
        $this->_addPermissionToSysAdminRole(101000, 'settings.modifySystemParameters', 'Settings > Modify System Parameters', $sys_admin_role->id);
        $this->_addPermissionToSysAdminRole(101100, 'settings.modifyModelsToAudit', 'Settings > Modify models to be audited', $sys_admin_role->id);

        UserRole::insert([
            'user_id' => $sys_admin_user->id,
            'role_id' => $sys_admin_role->id
        ]);

        SystemParameter::upsert(
            [
                [
                    '_seq' => 100000,
                    'param_type' => 'SYS',
                    'code' => 'ENABLE_CLIENT_LOGIN',
                    'description' => 'Enables logging requests from client',
                    'value_type' => 'boolean'
                ],
                [
                    '_seq' => 100100,
                    'param_type' => 'SYS',
                    'code' => 'ENABLE_BACKEND_LOGIN',
                    'description' => 'Enables logging requests to external APIs from server',
                    'value_type' => 'boolean'
                ],
                [
                    '_seq' => 100200,
                    'param_type' => 'USER',
                    'code' => 'DUMMY_DATE_OF_START',
                    'description' => 'Date type value',
                    'value_type' => 'date'
                ],
                [
                    '_seq' => 100300,
                    'param_type' => 'USER',
                    'code' => 'DUMMY_TEXT',
                    'description' => 'Text type value',
                    'value_type' => 'text'
                ],
                [
                    '_seq' => 100400,
                    'param_type' => 'SYS',
                    'code' => 'ENABLE_USER_LOGIN',
                    'description' => 'Enables logging of user sign-in and sign-out information',
                    'value_type' => 'boolean'
                ],
                [
                    '_seq' => 100500,
                    'param_type' => 'SYS',
                    'code' => 'ENABLE_USER_ACTIVE_LOGGING',
                    'description' => 'Enables logging of user active status',
                    'value_type' => 'boolean'
                ],
                [
                    '_seq' => 100600,
                    'param_type' => 'SYS',
                    'code' => 'ENABLE_MODEL_AUDITING',
                    'description' => 'Enables model auditing. Models to be audited can be selected in Settings > Models to Audit window.',
                    'value_type' => 'boolean'
                ]
            ],
            ['code'],
            ['description']
        );
    }
}
