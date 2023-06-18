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
        // print_r($request);die;
        $request->validate([
            'type_name' =>'required|unique:club_types|max:200',
            'type_icon' =>'required'
                    
        ]);

        ClubType::insert([
            
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
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
        ]);

        $notification = array(
            'message'    => 'Club Type Updated Succesfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.type')->with($notification);
    }//end method
}
