<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkExperience;

class WorkExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->workExperience;
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
            'from' => '',
            'to' => '',
            'organization' => '',
            'position' => '',
            'roles' => ''
        ]);
        $wx = new WorkExperience($input);
        auth()->user()->workExperience()->save($wx);
        return ['experience' => $wx, 'message' => 'Saved successfully.'];
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
        WorkExperience::destroy($id);
        return ['message' => 'Deleted successfully.'];
    }
}
