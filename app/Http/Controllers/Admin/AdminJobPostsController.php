<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jobposts;

class AdminJobPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Jobposts::all();
        return view('admin.jobsposted')->with('jobs',$jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(REQUEST $request)
    {
       
        $jobs = new Jobposts();

        $jobs->jobtitle =$request->input('jobtitle');
        $jobs->refno = $request->input('refno');
        $jobs->joblocation = $request->input('joblocation');
        $jobs->jobdescription = $request->input('jobdescription');
        $jobs->experiencelevel= $request->input('experiencelevel');
        $jobs->skillrequired= $request->input('skillrequired');
        $jobs->duties= $request->input('duties');
        $jobs->salaryrange= $request->input('salaryrange');
        $jobs->numberofposts= $request->input('numberofposts');
        $jobs->deadline = $request->input('deadline');
        $jobs->save();
        return redirect('/posted-jobs')->with('status','Job Posted successfully');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $jobs = Jobposts::findOrFail($id);

        return view('admin.editpostedjob')->with('jobs',$jobs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $jobs = Jobposts::findOrFail($id);

        $jobs->jobtitle =$request->input('jobtitle');
        $jobs->refno = $request->input('refno');
        $jobs->joblocation = $request->input('joblocation');
        $jobs->jobdescription = $request->input('jobdescription');
        $jobs->experiencelevel= $request->input('experiencelevel');
        $jobs->skillrequired= $request->input('skillrequired');
        $jobs->duties= $request->input('duties');
        $jobs->salaryrange= $request->input('salaryrange');
        $jobs->numberofposts= $request->input('numberofposts');
        $jobs->deadline = $request->input('deadline');
        $jobs->update();
        
        return redirect('/posted-jobs')->with('status','Job Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobs = Jobposts::findOrFail($id);
        
        $jobs->delete();
        return redirect('/posted-jobs')->with('status','Job Deleted Updated successfully');
    }
}
