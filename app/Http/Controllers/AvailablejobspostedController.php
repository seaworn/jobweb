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
        
       $job = Jobposts::find($id);
       return view('jobseeker.showjob')->with('job',$job);
    }
    public function applyjob($id){
        
        $job = Jobposts::find($id);
        return view('jobseeker.applyjobform')->with('job',$job);
    }
    
}
