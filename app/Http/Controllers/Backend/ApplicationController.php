<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ClubType;
use App\Models\MemberClub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Approval;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function AllApplication(){

        $id = Auth::user()->id;
        $clubTypes = ClubType::where('advisor_id', $id)->get();

        // $directorPermission = DB::table('model_has_roles')
        // ->select('model_has_roles.*', 'roles.*')
        // ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        // ->where('name', 'PENGARAH PISM')
        // ->where('model_id', $id)
        // ->get();
        $user = User::find(1);
        $directorPermission = $user->directorPermission($id);

        if ($clubTypes->isEmpty() && $directorPermission->isEmpty()) {
            $applications = Approval::with('user')
            ->get();
        }elseif($clubTypes->isNotEmpty()){ //applications for CLUB ADVISOR
            $applications = Approval::with('user')
            ->where('advisor_id', $id)
            ->get();  
        }elseif($directorPermission->isNotEmpty()){ //applications for PISM DIRECTOR
            $applications = Approval::where('advisor_approval', '=', 'APPROVED')
            ->get();
        }

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

        //filter to advisor only
        $id_advisor = Auth::user()->id;
        $advisorPermission = ClubType::where('advisor_id', $id_advisor)->get();

        $is_director = Auth::user()->id;
        $user = User::find(1);
        $directorPermission = $user->directorPermission($is_director);
        // print_r($directorPermission);die;

        if($advisorPermission->isNotEmpty() && $directorPermission->isEmpty()){
            $is_advisor =1;
            $is_director =0;
        }elseif($advisorPermission->isEmpty() && $directorPermission->isNotEmpty()){
            $is_advisor =0;
            $is_director =1;
        }else{
            $is_advisor =0;
            $is_director =0;
        }

        // print_r($approvals);die;
        return view('backend.application.edit_application',compact('approvals','is_advisor','is_director'));
    }

    public function UpdateApplication (Request $request){
    
        $pid = $request->id;

        // Initialize the $advisor_remark, $director_approval, and $director_remark variables
        $advisor_remark = '';
        $director_approval = '';
        $director_remark = '';
        
        // print_r($request->advisor_approval);die;
        if ($request->has('advisor_approval') && !empty($request->advisor_approval) && ($request->advisor_approval !='PENDING') && ($request->director_approval =='PENDING')) {
                // print_r('masuk1');die;
            if ($request->advisor_approval == 'APPROVED') {
                $status = 'WAITING FOR PISM DIRECTOR APPROVAL';
            } elseif ($request->advisor_approval == 'REJECTED') {
                $status = 'REJECTED BY CLUB ADVISOR';
            }else{
                $status = 'PENDING';
            }
        }elseif ($request->has('director_approval') && !empty($request->director_approval)) {
            // print_r('masuk2');die;
            if ($request->director_approval == 'APPROVED') {
                $status = 'PROGRAM APPROVED';
            } elseif ($request->director_approval == 'REJECTED') {
                $status = 'REJECTED BY PISM DIRECTOR';
            }else{
                $status = 'PENDING';
            }
        }


        $updateData = [
            'description' => $request->desc,
            'budget_request' => $request->budget_request,
            'venue' => $request->venue,
            'participant' => $request->participant,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $status
        ];

        if (!empty($request->advisor_approval)) {
            $updateData['advisor_approval'] = $request->advisor_approval;
        }

        if (!empty($request->advisor_remark)) {
            $updateData['advisor_remark'] = $request->advisor_remark;
        }
        
        if (!empty($request->director_approval)) {
            $updateData['director_approval'] = $request->director_approval;
        }

        if (!empty($request->director_remark)) {
            $updateData['director_remark'] = $request->director_remark;
        }
        
        Approval::findOrFail($pid)->update($updateData);

        $notification = array(
            'message'    => 'Program details Updated Succesfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.application')->with($notification);
    }
}
