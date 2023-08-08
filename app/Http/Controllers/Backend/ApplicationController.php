<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Approval;

class ApplicationController extends Controller
{
    public function AllApplication(){
        
        $applications = Approval::with('user')->get();
        return view ('backend.application.app_dashboard',compact('applications'));
    }
}
