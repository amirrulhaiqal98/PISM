<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MemberClub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Approval;

class ApplicationController extends Controller
{
    public function AllApplication(){
        
        $applications = Approval::with('user')->get();
        return view ('backend.application.all_application',compact('applications'));
    }

    public function AddApplication(){
        return view ('backend.application.add_application');
    }

    public function StoreApplication(Request $request){

        $id = Auth::user()->id;
        $app = new Approval;
        $app->user_id = $id;
        $app->resource_id = 1;
        $app->description = $request->desc;
        $app->budget_request = $request->budget_request;
        $app->venue = $request->venue;
        $app->participant = $request->participant;
        $app->start_date = $request->start_date;
        $app->end_date = $request->end_date;

        $members = MemberClub::select('member_club.club_id', 'ct.advisor_id')
        ->leftJoin('roles as rl', 'rl.id', '=', 'member_club.role_id')
        ->leftJoin('club_types as ct', 'ct.id', '=', 'member_club.club_id')
        ->where('users_id', $id)
        ->where('rl.name', 'SETIAUSAHA KELAB')
        ->get();

        if($members[0]['club_id']){
            $app->club_id = $members[0]['club_id'];
        }
        if($members[0]['advisor_id']){
            $app->advisor_id = $members[0]['advisor_id'];
        }
        // $user->role = 'admin';
        // $user->status = 'active';
        $app->save();
        
        $notification = array(
            'message' => 'New Approval Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.application')->with(($notification));
    }

    public function EditApplication($id){
        
        $approvals = Approval::findOrFail($id);
        // print_r($approvals);die;
        return view('backend.application.edit_application',compact('approvals'));
    }

    public function UpdateApplication (Request $request){
    
        $pid = $request->id;

        Approval::findOrFail($pid)->update([
            'description'       => $request->desc,
            'budget_request'    => $request->budget_request,
            'venue'             => $request->venue,
            'participant'       => $request->participant,
            'start_date'        => $request->start_date,
            'end_date'          => $request->end_date
        ]);

        $notification = array(
            'message'    => 'Program details Updated Succesfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.application')->with($notification);
    }
}
