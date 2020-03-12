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
        return auth()->user()->academicQualifications;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'institution' => '',
            'from' => '',
            'to' => '',
            'academic_level' => '',
            'course' => '',
            'specialization' => '',
            'grade' => '',
            'attachment' => ''
        ]);
        // return response()->json($input, 500);
        $input = collect($input);
        $aq = new AcademicQualification($input->only([
            'institution',
            'from',
            'to',
            'academic_level',
            'course',
            'specialization',
            'grade'
        ])->all());
        $aq->attachment_filepath = $request->file('attachment')->store('uploads');
        auth()->user()->academicQualifications()->save($aq);
        return ['academicQualification'=> $aq, 'message'=> 'Saved succesfully.'];
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
        AcademicQualification::destroy($id);
        return ['message' => 'Deleted successfully.'];
    }
}
