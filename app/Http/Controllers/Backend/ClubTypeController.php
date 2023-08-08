<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ClubType;

class ClubTypeController extends Controller
{
    //
    public function AllType (){
        $types = ClubType::latest()->get();
        return view('backend.type.all_type',compact('types'));
    }
    
    public function AddType (){
        
        return view('backend.type.add_type');
    }
    
    public function StoreType (Request $request){

        $request->validate([
            'type_name' =>'required|unique:club_types|max:200',
            'type_icon' =>'required',
            'club_description' =>'required|unique:club_types|max:200',
            'club_email' =>'required',
            'advisor_id' =>'required',
            'advisor_email' =>'required',
            'advisor_phone' =>'required',
            'president_id' =>'required',
            'secretary_id' =>'required',
            'treasurer_id' =>'required'
                    
        ]);

        ClubType::insert([
            
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
            'club_description' => $request->club_description,
            'club_email' => $request->club_email,
            'advisor_id' => $request->advisor_id,
            'advisor_email' => $request->advisor_email,
            'advisor_phone' => $request->advisor_phone,
            'president_id' => $request->president_id,
            'secretary_id' => $request->secretary_id,
            'treasurer_id' => $request->treasurer_id,
        ]);

        $notification = array(
            'message'    => 'Club Type Create Succesfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.type')->with($notification);
    }//end method

    public function EditType($id){
        
        $types = ClubType::findOrFail($id);
        return view('backend.type.edit_type',compact('types'));
    }

    public function UpdateType (Request $request){

        $pid = $request->id;

        ClubType::findOrFail($pid)->update([
            
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
            'club_description' => $request->club_description,
            'club_email' => $request->club_email,
            'advisor_id' => $request->advisor_id,
            'advisor_email' => $request->advisor_email,
            'advisor_phone' => $request->advisor_phone,
            'president_id' => $request->president_id,
            'secretary_id' => $request->secretary_id,
            'treasurer_id' => $request->treasurer_id,
        ]);

        $notification = array(
            'message'    => 'Club Type Updated Succesfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.type')->with($notification);
    }//end method

    public function DeleteType($id){

        ClubType::findOrFail($id)->delete();
        
        
        $notification = array(
            'message'    => 'Club Type Deleted Succesfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
        }//end method

}
