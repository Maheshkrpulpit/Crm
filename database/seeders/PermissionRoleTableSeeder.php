<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        // Super Admin Permission
        $all_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($all_permissions);

        // Admin permission
        $adminPermissionCollection = ['user.*','permissions.*','roles.*','master_management.menu','system_fields.*','brands.*','packages.*','departments.*','asign_brands.*'];

        if(count($adminPermissionCollection) > 0){
            $admin_permissions = $all_permissions->filter(function ($permission) use($adminPermissionCollection) {
                $permissionName = $permission->name;
                $permissionNameArr = explode('.', $permission->name);
                if(count($permissionNameArr) >= 2 && in_array($permissionNameArr[0].'.*', $adminPermissionCollection)){
                    $permissionName = $permissionNameArr[0].'.*';
                }else{
                    $permissionName = $permissionName ;
                }
                return in_array($permissionName,$adminPermissionCollection);
            });
            Role::findOrFail(2)->permissions()->sync($admin_permissions);
        }

        // Teacher permission
        $teacherPermissionCollection = [];
        if(count($teacherPermissionCollection) > 0){
            $admin_permissions = $all_permissions->filter(function ($permission) use($teacherPermissionCollection) {
                $permissionName = $permission->name;
                $permissionNameArr = explode('.', $permission->name);
                if(count($permissionNameArr) >= 2 && in_array($permissionNameArr[0].'.*', $teacherPermissionCollection)){
                    $permissionName = $permissionNameArr[0].'.*';
                }else{
                    $permissionName = $permissionName;
                }
                return in_array($permissionName,$teacherPermissionCollection);
            });
            Role::findOrFail(3)->permissions()->sync($admin_permissions);
        }

        // Parent permission
        $parentPermissionCollection = [];
        if(count($parentPermissionCollection) > 0){
            $admin_permissions = $all_permissions->filter(function ($permission) use($parentPermissionCollection) {
                $permissionName = $permission->name;
                $permissionNameArr = explode('.', $permission->name);
                if(count($permissionNameArr) >= 2 && in_array($permissionNameArr[0].'.*', $parentPermissionCollection)){
                    $permissionName = $permissionNameArr[0].'.*';
                }else{
                    $permissionName = $permissionName;
                }
                return in_array($permissionName,$parentPermissionCollection);
            });
            Role::findOrFail(3)->permissions()->sync($admin_permissions);
        }

        // Student permission
        $studentPermissionCollection = [];
        if(count($studentPermissionCollection) > 0){
            $admin_permissions = $all_permissions->filter(function ($permission) use($studentPermissionCollection) {
                $permissionName = $permission->name;
                $permissionNameArr = explode('.', $permission->name);
                if(count($permissionNameArr) >= 2 && in_array($permissionNameArr[0].'.*', $studentPermissionCollection)){
                    $permissionName = $permissionNameArr[0].'.*';
                }else{
                    $permissionName = $permissionName ;
                }
                return in_array($permissionName,$studentPermissionCollection);
            });
            Role::findOrFail(3)->permissions()->sync($admin_permissions);
        }

    }
}