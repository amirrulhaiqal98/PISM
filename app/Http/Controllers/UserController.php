<?php

namespace App\Http\Controllers;

use App\Models\ClubType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB; // Import the DB facade
use App\Providers\RouteServiceProvider;


class UserController extends Controller
{
    public function UserSignup()
    {
        $clubs = ClubType::all();
        return view('admin.admin_signUp',compact('clubs'));
    }

    // public function StoreUser(Request $request){

    //     $memberRole = Role::where('name', 'member')->first();

    //     $user = new User;
    //     $user->username = $request->username;
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password);
    //     $user->role = 'admin';
    //     $user->status = 'active';
    //     $user->role_id = $memberRole->id;
    //     $user->save();

    //     $user->assignRole($memberRole->id);

    //     // Assuming the form field name is 'clubs[]'
    //     $clubIds = $request->clubs;

    //     // Insert into the member_club table
    //     foreach ($clubIds as $clubId) {
    //         DB::table('member_club')->insert([
    //             'users_id' => $user->id,
    //             'club_id' => $clubId,
    //             'role_id' => $memberRole->id,
    //             'status' => 'active',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }
        
    //     $notification = array(
    //         'message' => 'New User Registered Successfully',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('admin.dashboard')->with($notification);
    // }
    public function StoreUser(Request $request)
{
    $memberRole = Role::where('name', 'member')->first();

    $user = new User;
    $user->username = $request->username;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->role = 'admin';
    $user->status = 'active';
    $user->role_id = $memberRole->id;
    $user->save();

    $user->assignRole($memberRole->id);

    // Assuming the form field name is 'clubs[]'
    $clubIds = $request->clubs;

    // Insert into the member_club table
    foreach ($clubIds as $clubId) {
        DB::table('member_club')->insert([
            'users_id' => $user->id,
            'club_id' => $clubId,
            'role_id' => $memberRole->id,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Manually login the user
    Auth::login($user);

    $notification = array(
        'message' => 'New User Registered Successfully',
        'alert-type' => 'success'
    );

    //verify email address
    if ($request->user()->hasVerifiedEmail()) {
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    $request->user()->sendEmailVerificationNotification();

    // return back()->with('status', 'verification-link-sent');

    return redirect()->route('admin.dashboard')->with($notification);
}
}
