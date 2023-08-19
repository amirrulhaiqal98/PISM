<?php

namespace App\Http\Controllers;

use App\Models\ClubType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserController extends Controller
{
    public function UserSignup()
    {
        $clubs = ClubType::all();
        return view('admin.admin_signUp',compact('clubs'));
    }

    public function StoreUser(Request $request){

        $memberRole = Role::where('name', 'member')->first();

        print_r($memberRole->id);die;
        $user = new User;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'member';
        $user->status = 'active';
        $user->role_id = $memberRole->id;
        $user->save();
        
        $notification = array(
            'message' => 'New User Registered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.dashboard')->with(($notification));
    }
}
