<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageControllers extends Controller
{
  public function index(){
    return view('jobseeker.jobsavailable');
    
  }
}
