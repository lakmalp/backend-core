<?php

namespace Premialabs\Seeders;

use Premialabs\Foundation\SystemParameter;
use Premialabs\Foundation\Permission\gen\Permission;
use Illuminate\Database\Seeder;
use Premialabs\Foundation\Role\gen\Role;
use Premialabs\Foundation\RolePermission\gen\RolePermission;
use Premialabs\Foundation\UserRole\gen\UserRole;

class AddPermissionsToSysAdminRoleSeeder extends Seeder
{
    private $sys_admin_role_id;
    private $_perm_seq = null;
    private $_role_perm_seq = null;

    public function __construct()
    {
        $max_seq = Permission::max('_seq');
        $this->_perm_seq = (is_null($max_seq) ? 100000 : $max_seq + 100);

        $max_seq = RolePermission::max('_seq');
        $this->_role_perm_seq = (is_null($max_seq) ? 100000 : $max_seq + 100);

        $this->sys_admin_role_id = Role::where('code', 'SYS_ADMIN')->first()->id;
    }

    private function _createOrUpdatePermission($endpoint, $method, $action)
    {
        $perm = Permission::where(['endpoint' => $endpoint, 'method' => $method])->first();

        if (is_null($perm)) {
            $perm = Permission::create([
                '_seq' => $this->_perm_seq,
                'method' => $method,
                'endpoint' => $endpoint,
                'action' => $action
            ]);
            $this->_perm_seq = $this->_perm_seq + 100;
        } else {
            $perm->action = $action;
            $perm->save();
        }

        return $perm;
    }

    private function _createRolePermission($perm, $sys_role_id)
    {
        RolePermission::create([
            '_seq' => $this->_role_perm_seq,
            'permission_id' => $perm->id,
            'role_id' => $sys_role_id
        ]);
        $this->_role_perm_seq = $this->_role_perm_seq + 100;
    }

    private function _addPermissionToRole($endpoint, $method, $action, $sys_role_id)
    {
        $perm = $this->_createOrUpdatePermission($endpoint, $method, $action);
        $this->_createRolePermission($perm, $sys_role_id);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->_addPermissionToRole('api/fnd/auditableModels', 'GET', 'AuditableModelController@index', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/auditableModels', 'POST', 'AuditableModelController@create', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/auditableModels/{auditableModel}', 'DELETE', 'AuditableModelController@delete', $this->sys_admin_role_id);

        $this->_addPermissionToRole('api/fnd/permissions', 'POST', 'PermissionController@create', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/permissions/{permission}', 'GET', 'PermissionController@show', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/permissions', 'GET', 'PermissionController@query', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/permissions/{permission}', 'PATCH', 'PermissionController@update', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/permissions/{permission}', 'DELETE', 'PermissionController@delete', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/permissions/prepareCreate', 'GET', 'PermissionController@prepareCreate', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/permissions/{permission}/prepareDuplicate', 'GET', 'PermissionController@prepareDuplicate', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/permissions/{permission}/prepareEdit', 'GET', 'PermissionController@prepareEdit', $this->sys_admin_role_id);

        $this->_addPermissionToRole('api/fnd/rolePermissions', 'POST', 'RolePermissionController@create', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/rolePermissions/{rolePermission}', 'GET', 'RolePermissionController@show', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/rolePermissions', 'GET', 'RolePermissionController@query', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/rolePermissions/{rolePermission}', 'PATCH', 'RolePermissionController@update', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/rolePermissions/{rolePermission}', 'DELETE', 'RolePermissionController@delete', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/rolePermissions/prepareCreate', 'GET', 'RolePermissionController@prepareCreate', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/rolePermissions/{rolePermission}/prepareDuplicate', 'GET', 'RolePermissionController@prepareDuplicate', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/rolePermissions/{rolePermission}/prepareEdit', 'GET', 'RolePermissionController@prepareEdit', $this->sys_admin_role_id);

        $this->_addPermissionToRole('api/fnd/roles', 'POST', 'RoleController@create', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/roles/{role}', 'GET', 'RoleController@show', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/roles', 'GET', 'RoleController@query', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/roles/{role}', 'PATCH', 'RoleController@update', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/roles/{role}', 'DELETE', 'RoleController@delete', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/roles/prepareCreate', 'GET', 'RoleController@prepareCreate', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/roles/{role}/prepareDuplicate', 'GET', 'RoleController@prepareDuplicate', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/roles/{role}/prepareEdit', 'GET', 'RoleController@prepareEdit', $this->sys_admin_role_id);

        $this->_addPermissionToRole('api/fnd/userRoles', 'POST', 'UserRoleController@create', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/userRoles/{userRole}', 'GET', 'UserRoleController@show', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/userRoles', 'GET', 'UserRoleController@query', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/userRoles/{userRole}', 'PATCH', 'UserRoleController@update', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/userRoles/{userRole}', 'DELETE', 'UserRoleController@delete', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/userRoles/prepareCreate', 'GET', 'UserRoleController@prepareCreate', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/userRoles/{userRole}/prepareDuplicate', 'GET', 'UserRoleController@prepareDuplicate', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/userRoles/{userRole}/prepareEdit', 'GET', 'UserRoleController@prepareEdit', $this->sys_admin_role_id);

        $this->_addPermissionToRole('api/fnd/systemParameters', 'GET', 'SystemParameterController@index', $this->sys_admin_role_id);
        $this->_addPermissionToRole('api/fnd/systemParameters', 'PATCH', 'SystemParameterController@update', $this->sys_admin_role_id);

        // $this->_addPermissionToRole($this->_fetchSeq(), 'login', 'POST', 'AuthenticatedSessionController@store', $this->sys_admin_role_id);
        // $this->_addPermissionToRole($this->_fetchSeq(), 'logout', 'POST', 'AuthenticatedSessionController@destroy', $this->sys_admin_role_id);
        // $this->_addPermissionToRole($this->_fetchSeq(), 'sanctum/csrf-cookie', 'GET', 'CsrfCookieController@show', $this->sys_admin_role_id);
    }
}
