<?php

namespace App\Http\Controllers\Admin\Permissiongroup;

use App\Http\Controllers\Controller;
use App\Models\Core\UserPermission;
use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Core\PermissionGroup;
use App\Repositories\SearchRepo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class IndexController extends Controller
{
            /**
         * return permissiongroup's index view
         */
    public function index(){
        return view($this->folder.'index');
    }


    public function viewPermissionGroup($permission_group_id){

        $permissionGroup =PermissionGroup::findOrFail($permission_group_id);
        $permissions= json_decode(file_get_contents(storage_path("app/system/roles.json")));
//        dd(json_decode($permissionGroup->permissions) ?? []);
        return view($this->folder.'permission_group',[
            'permissionGroup'=> $permissionGroup,
            'usersWithPermissions'=> User::where('role','store')->whereNotNull('permission_group_id')->get(),
            'permissions' => $permissions,
            'existing' => json_decode($permissionGroup->permissions) ?? [],
            'existing_menu_item_permissions' => json_decode($permissionGroup->menu_item_permissions) ?? []
        ]);
    }

    /**
     * store permissiongroup
     */
    public function storePermissionGroup(){
        request()->validate($this->getValidationFields(['name','description']));
        $data = \request()->all();
        if(!isset($data['user_id'])) {
            if (Schema::hasColumn('permission_groups', 'user_id'))
                $data['user_id'] = request()->user()->id;
        }
        $data['slug'] = Str::slug($data['name']);
        $this->autoSaveModel($data);

        $action= (\request()->id) ? "updated" : "saved";
        return redirect()->back()->with('notice',['type'=>'success','message'=>'PermissionGroup '.$action.' successfully']);
    }

    public function removeUser($user_id){
        $user = User::findOrFail($user_id);
        if (!$user)
            return back()->with('notice',['type'=>'success','message'=>'User Permission has been successfully revoked']);
        $user->permission_group_id = null;
        $user->save();

        return back()->with('notice',['type'=>'success','message'=>'User Permission has been successfully revoked']);
    }

    /**
     * return permissiongroup values
     */
    public function listPermissionGroups(){
        $permissiongroups = PermissionGroup::where([
            ['id','>',0]
        ]);
        if(\request('all'))
            return $permissiongroups->get();
        return SearchRepo::of($permissiongroups)
            ->addColumn('Admins', function ($permissiongroup) {
                $str = '<ul>';
                $users = $permissiongroup->users;
                foreach ($users as $user) {
                    $str .= '<li>' . $user->name . ' <span onclick="runPlainRequest(\'' . url("admin/permissiongroup/remove/$user->id") . '\')" style="color: #f44336; cursor: pointer"><i class="fa fa-times"></i></span></li>';
                }
                $str .= '</ul>';
                return $str;
            })
            ->addColumn('permissions',function($permissiongroup){
                $str = '<ul>';
                $permissions = json_decode($permissiongroup->permissions);
                if (!$permissions)
                    $permissions = [];
                foreach ($permissions as $permission) {
                    $str .= '<li>' . ucwords(str_replace('_', ' ', $permission)) . '</li>';
                }
                $str .= '</ul>';
//                $str.='<a onclick="getDepartmentPermission('.$permissiongroup->id.');" href="#permissions_modal" data-bs-toggle="modal" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit</a>';
                return $str;
            })

            ->addColumn('action',function($permissiongroup){
                $str = '';
                $json = json_encode($permissiongroup);
//                $str.='<a href="#" data-model="'.htmlentities($json, ENT_QUOTES, 'UTF-8').'" onclick="prepareEdit(this,\'permissiongroup_modal\');" class="btn badge btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>';
                $str.='<a href="'.url("admin/permissiongroup/".$permissiongroup->id).'" class="btn badge btn-info btn-sm m-2"><i class="fa fa-eye"></i> View</a>';
            //    $str.='&nbsp;&nbsp;<a href="#" onclick="deleteItem(\''.url(request()->user()->role.'/permissiongroups/delete').'\',\''.$permissiongroup->id.'\');" class="btn badge btn-outline-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>';
                return $str;
            })->make();
    }

    /**
     * delete permissiongroup
     */
    public function destroyPermissionGroup($permissiongroup_id)
    {
        $permissiongroup = PermissionGroup::findOrFail($permissiongroup_id);
        $permissiongroup->delete();
        return redirect()->back()->with('notice',['type'=>'success','message'=>'PermissionGroup deleted successfully']);
    }

}
