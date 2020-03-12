<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jobposts;

class AvailablejobspostedController extends Controller
{
    public function index(){

        $jobs = Jobposts::all();
        return view('jobseeker.jobsavailable')->with('jobs',$jobs);
    }
    public function show($id){
        
       $jobs = Jobposts::find($id);
       return view('')->with('jobs',$jobs);
    }
}
