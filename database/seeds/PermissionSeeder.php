<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Admin;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $system = Permission::create(['pid' => 0, 'name' => 'system', 'title' => '系统', 'icon' => 'el-icon-s-tools', 'path' => '/system', 'component' => 'layout/Layout', 'guard_name' => 'admin', 'hidden' => 0]);

        $permissionAndRole = Permission::create(['pid' => $system->id, 'name' => 'permission-role', 'title' => '权限管理', 'icon' => 'lock', 'path' => '/permission-role', 'component' => 'rview', 'guard_name' => 'admin', 'hidden' => 0]);

        $permission = Permission::create(['pid' => $permissionAndRole->id, 'name' => 'permission.permissions', 'title' => '权限列表', 'icon' => 'el-icon-key', 'path' => 'permissions', 'component' => 'permission/permissions', 'guard_name' => 'admin', 'hidden' => 0]);
        Permission::create(['pid' => $permission->id, 'name' => 'permission.create', 'title' => '添加权限', 'icon' => 'icon', 'path' => 'permission/create', 'component' => 'permission/create', 'guard_name' => 'admin', 'hidden' => 1]);
        Permission::create(['pid' => $permission->id, 'name' => 'permission.update', 'title' => '编辑权限', 'icon' => 'icon', 'path' => 'permission/update', 'component' => 'permission/update', 'guard_name' => 'admin', 'hidden' => 1]);
        Permission::create(['pid' => $permission->id, 'name' => 'permission.delete', 'title' => '删除权限', 'icon' => 'icon', 'path' => 'permission/delete', 'component' => 'permission/delete', 'guard_name' => 'admin', 'hidden' => 1]);
        Permission::create(['pid' => $permission->id, 'name' => 'permission.permission', 'title' => '权限详情', 'icon' => 'icon', 'path' => 'permission', 'component' => 'permission/permission', 'guard_name' => 'admin', 'hidden' => 1]);

        $role = Permission::create(['pid' => $permissionAndRole->id, 'name' => 'role.roles', 'title' => '角色列表', 'icon' => 'el-icon-s-custom', 'path' => 'roles', 'component' => 'role/roles', 'guard_name' => 'admin', 'hidden' => 0]);
        Permission::create(['pid' => $role->id, 'name' => 'role.create', 'title' => '添加角色', 'icon' => 'icon', 'path' => 'role/create', 'component' => 'role/create', 'guard_name' => 'admin', 'hidden' => 1]);
        Permission::create(['pid' => $role->id, 'name' => 'role.update', 'title' => '编辑角色', 'icon' => 'icon', 'path' => 'role/update', 'component' => 'role/update', 'guard_name' => 'admin', 'hidden' => 1]);
        Permission::create(['pid' => $role->id, 'name' => 'role.delete', 'title' => '删除角色', 'icon' => 'icon', 'path' => 'role/delete', 'component' => 'role/delete', 'guard_name' => 'admin', 'hidden' => 1]);
        Permission::create(['pid' => $role->id, 'name' => 'role.role', 'title' => '角色详情', 'icon' => 'icon', 'path' => 'role/role', 'component' => 'role/role', 'guard_name' => 'admin', 'hidden' => 1]);
        Permission::create(['pid' => $role->id, 'name' => 'role.syncPermissions', 'title' => '分配权限/目录', 'icon' => 'icon', 'path' => 'role/syncPermissions', 'component' => 'role/syncPermissions', 'guard_name' => 'admin', 'hidden' => 1]);
        Permission::create(['pid' => $role->id, 'name' => 'role.syncRoles', 'title' => '分配用户', 'icon' => 'icon', 'path' => 'role/syncRoles', 'component' => 'role/syncRoles', 'guard_name' => 'admin', 'hidden' => 1]);


        $admin = Permission::create(['pid' => 0, 'name' => 'admin.admins', 'title' => '管理员列表', 'icon' => 'el-icon-user-solid', 'path' => '/admins', 'component' => 'admin/admins', 'guard_name' => 'admin', 'hidden' => 0]);
        Permission::create(['pid' => $admin->id, 'name' => 'admin.create', 'title' => '添加管理员', 'icon' => 'icon', 'path' => 'admin/create', 'component' => 'admin/create', 'guard_name' => 'admin', 'hidden' => 1]);
        Permission::create(['pid' => $admin->id, 'name' => 'admin.update', 'title' => '编辑管理员', 'icon' => 'icon', 'path' => 'admin/update', 'component' => 'admin/update', 'guard_name' => 'admin', 'hidden' => 1]);
        Permission::create(['pid' => $admin->id, 'name' => 'admin.delete', 'title' => '删除管理员', 'icon' => 'icon', 'path' => 'admin/delete', 'component' => 'admin/delete', 'guard_name' => 'admin', 'hidden' => 1]);
        Permission::create(['pid' => $admin->id, 'name' => 'admin.admin', 'title' => '管理员详情', 'icon' => 'icon', 'path' => 'admin/admin', 'component' => 'admin/admin', 'guard_name' => 'admin', 'hidden' => 1]);
        Permission::create(['pid' => $admin->id, 'name' => 'admin.syncPermissions', 'title' => '授权权限', 'icon' => 'icon', 'path' => 'admin/syncPermissions', 'component' => 'admin/syncPermissions', 'guard_name' => 'admin', 'hidden' => 1]);

        Permission::create(['pid' => $system->id, 'name' => 'activeLog.activeLogs', 'title' => '操作记录', 'icon' => 'el-icon-tickets', 'path' => '/activeLogs', 'component' => 'activeLog/activeLogs', 'guard_name' => 'admin', 'hidden' => 0]);

        $role1 = Role::create(['name' => 'Admin', 'guard_name' => 'admin']);
        $role1->givePermissionTo([
            'system',
            'permission-role',
            'permission.permissions',
            'permission.permission',
            'permission.create',
            'permission.update',
            'permission.delete',
            'role.roles',
            'role.role',
            'role.create',
            'role.update',
            'role.delete',
            'role.syncPermissions',
            'role.syncRoles',
            'admin.admins',
            'admin.admin',
            'admin.create',
            'admin.update',
            'admin.delete',
            'admin.syncPermissions',
            'activeLog.activeLogs'
        ]);

        $user = Admin::find(1);
        $user->assignRole('Admin');

        $role2 = Role::create(['name' => 'Test', 'guard_name' => 'admin']);
        $role2->givePermissionTo([
            'system',
            'permission-role',
            'permission.permissions',
            'permission.permission',
            'role.roles',
            'role.role',
            'admin.admins',
            'admin.admin',
            'activeLog.activeLogs'
        ]);
        $user = Admin::find(2);
        $user->assignRole('Test');
    }
}
