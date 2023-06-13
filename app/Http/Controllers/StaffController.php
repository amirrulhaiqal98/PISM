<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function StaffDashboard(){
        return view('staff.staff_dashboard');
    }

    public function StaffProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('staff.staff_profile_view',compact('profileData'));
    }

    public function StaffLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
