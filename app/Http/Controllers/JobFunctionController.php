<?php

namespace App\Http\Controllers;

use App\JobFunction;
use Illuminate\Http\Request;

class JobFunctionController extends Controller
{
    public function index()
    {
        return JobFunction::get();
    }
}
