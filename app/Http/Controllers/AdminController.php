<?php

namespace App\Http\Controllers;

use App\Models\ClubType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{
    public function AdminDashboard(){

        $results = ClubType::leftJoin('approvals', 'club_types.id', '=', 'approvals.club_id')
            ->select('club_types.type_name', DB::raw('SUM(approvals.budget_request) AS total_budget_request'))
            ->groupBy('club_types.type_name')
            ->get();
        

        return view('admin.index',compact('results'));
        
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
    
    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_profile_view',compact('profileData'));
    }
   
    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data -> username = $request->username;
        $data -> name = $request->name;
        $data -> email = $request->email;
        $data -> phone = $request->phone;
        $data -> address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message'    => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        
        return view('admin.admin_change_password',compact('profileData'));
    }
    public function AdminUpdatePassword(Request $request)
    {
        //validation
        $request->validate([
            'old_password' =>'required',
            'new_password' =>'required|confirmed'
                    
        ]);

        //match the old password
        if (!Hash::check($request->old_password, auth::user()->password)){
            //code
            $notification = array(
                'message'    => 'Old Password Does Not Match!',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        // update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message'    => 'Password Change Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    // ADMIN USER ALL METHOD  
    public function AllAdmin(){

        $allAdmin = User::where('role','admin')->get();
        return view ('backend.pages.admin.all_admin',compact('allAdmin'));
    
    }
    public function AddAdmin(){

        $roles = Role::all();
        return view ('backend.pages.admin.add_admin',compact('roles'));
    }

    public function StoreAdmin(Request $request){

        $user = new User;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if($request->roles){
            $user->assignRole($request->roles);
        }
        
        $notification = array(
            'message' => 'New Admin User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with(($notification));
    }

    public function EditAdmin($id){

        $user = User::findOrFail($id);
        $roles = Role::all();

        return view ('backend.pages.admin.edit_admin',compact('roles','user'));
    }

    public function UpdateAdmin(Request $request, $id){

        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();

        if($request->roles){
            $user->assignRole($request->roles);
        }
        
        $notification = array(
            'message' => 'New Admin User Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with(($notification));
    }

    public function DeleteAdmin($id){

    $user = User::findOrFail($id);

       if(!is_Null($user)){
            $user->delete();
        }

        $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with(($notification));

    }//END METHOD
    
}
