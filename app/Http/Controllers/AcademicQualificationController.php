<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AcademicQualification;

class AcademicQualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->academic_qualifications;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $input = $request->validate([

        // ]);
        $input = $request->all();
        $user = auth()->user();
        $aq = new AcademicQualification();
        $aq->institution = $input['institution'];
        $aq->from = $input['from'];
        $aq->to = $input['to'];
        $aq->academic_level = $input['academicLevel'];
        $aq->course = $input['course'];
        $aq->specialization = $input['specialization'];
        $aq->grade = $input['grade'];
        $aq->user_id = $user->id;
        $file = $request->file('file');
        $path = $file->store('uploads');
        $aq->file_path = $path;
        $aq->save();

        return ['aq'=> $aq, 'message'=> 'Saved succesfully.'];
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
