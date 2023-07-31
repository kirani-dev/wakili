<?php

namespace App\Http\Controllers\Admin\Permissiongroup;

use App\Http\Controllers\Controller;
use App\Models\Core\PermissionGroup;
use App\Models\Core\UserPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionGroupController extends Controller
{
    public function updatePermissions($permission_group_id){
        $permissionGroup = PermissionGroup::findOrFail($permission_group_id);

        $permissions = \request('permissions') != null ? \request('permissions') : [];
        $menu_item_permissions = \request('menu_item_permissions') != null ? \request('menu_item_permissions') : [];

//        dd($menu_item_permissions);
        $permissionGroup->permissions = json_encode($permissions);
        $permissionGroup->menu_item_permissions = $menu_item_permissions;
        $permissionGroup->_id = Str::orderedUuid();
        $permissionGroup->save();

        return back()->with('notice', ['type' => 'success', 'message' => 'Permissions Updated successfully']);
    }

    public function listUsersWithoutPermissions(){
        //TODO check users with listed permission groups
        return User::where('role','store')
            ->whereNull('permission_group_id')
            ->select('id','full_name as label')
        ->get();
    }

    public function addUserToPermissionGroup($permission_group_id){
//        foreach (\request('users') as $user_id){
//        dd(\request('users'));
            User::updateOrCreate([
                'id'=>\request('users')
            ],[
                'permission_group_id'=>$permission_group_id
                ]
            );
//        }
        return back()->with('notice', ['type' => 'success', 'message' => 'Users Added to Group successfully']);

    }
}
