<?php

namespace App\Http\Controllers;

use App\Job;
use App\JobFunction;
use Illuminate\Http\Request;

class JobController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Job::with(['contractType', 'jobFunction'])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = collect($request->validate([
            'title' => '',
            'ref_no' => '',
            'location' => '',
            'job_function' => '',
            'new_job_function' => '',
            'contract_type_id' => 'integer',
            'experience_level' => '',
            'skills_required' => '',
            'duties' => '',
            'salary_range' => '',
            'no_of_openings' => '',
            'expiry' => '',
        ]));
        $job = new Job($input->except(['job_function', 'new_job_function'])->all());
        $jfn = $input['job_function'] ?? $input['new_job_function'];
        $func = JobFunction::firstOrCreate(['name' => $jfn,]);
        $job->job_function_id = $func->id;
        $job->save();
        return ['job' => $job, 'message' => 'Job Posted successfully.'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return ['message' => 'Job deleted successfully.',];
    }

    public function applyJob(Request $request,Job $job){
        return 'hello';
        $input = $request->validate([
            'cover_letter'=>'',
            'cv'=>''
        ]);
        $user =auth()->user();
        $cv_filepath=$request->files('cv')->store('uploads');
        $user->applications()->save($job,['cover_letter'=>$input['cover_letter'],'cv_filepath'=>$cv_filepath]);
        return redirect(route('joblist'))->with('status','application successfull');

    }
    public function apply(Request $request, $job){
        $input = $request->validate([
            'cover_letter'=>'',
            'cv'=>''
        ]);
        $job = Job::find($job);
        $user =auth()->user();
        $cv_filepath=$request->file('cv')->store('uploads');
        $user->applications()->save($job,['cover_letter'=>$input['cover_letter'],'cv_filepath'=>$cv_filepath]);
        return redirect(route('joblist'))->with('status','application successfull');
    }
}
