<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //
    public function AllPermission(){

        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission',compact('permissions'));
    }

    public function AddPermission(){

        return view('backend.pages.permission.add_permission' );
    }

    public function StorePermission(Request $request ){

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Create Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with(($notification));

    }//End method

    public function EditPermission($id){

        $permission = Permission::findOrFail($id);
        return view ('backend.pages.permission.edit_permission',compact('permission'));

    }//End method

    public function UpdatePermission(Request $request ){

        $per_id = $request->id;

        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with(($notification));

    }//End method

    public function DeletePermission($id){

        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with(($notification));

    }// End method

    //Role all Method

    public function allRoles(){

        $roles = Role::all();
        return view('backend.pages.roles.all_roles',compact('roles'));

    }

    public function AddRoles(){

        return view('backend.pages.roles.add_roles' );
    }

    public function StoreRoles(Request $request ){

       Role::create([
            'name' => $request->name
          ]);

        $notification = array(
            'message' => 'Role Create Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with(($notification));

    }//End method

    public function EditRoles($id){

        $roles = Role::findOrFail($id);
        return view ('backend.pages.roles.edit_roles',compact('roles'));

    }//End method

    public function UpdateRoles(Request $request ){

        $role_id = $request->id;

        Role::findOrFail($role_id)->update([
            'name' => $request->name
        ]);

        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with(($notification));

    }//End method

    public function DeleteRoles($id){

        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Roles Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with(($notification));

    }// End method

    /* Add roles permission all method */

    public function AddRolesPermission(){

        $roles = Role::all();
        $permission = Permission::all();
        $permission_groups = User::getPermissionGroups();

        $permission_groups = User::getPermissionGroups();
        return view ('backend.pages.rolesetup.add_roles_permission',compact('roles','permission','permission_groups'));

    }//End method

    public function RolePermissionStore(Request $request){
        
        $data = array();
        $permissions = $request->permission;
        // print_r($request);die;
        foreach($permissions as $key => $item){
            $data['role_id']= $request->role_id;
            $data['permission_id']= $item;

            // var_dump(($data));die;
            DB::table('role_has_permissions')->insert($data);

        }// End Foreach

        $notification = array(
            'message' => 'Roles Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with(($notification));
    }//End method



}
