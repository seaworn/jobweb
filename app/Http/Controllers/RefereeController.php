<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Referee;

class RefereeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->referees;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $ref = new Referee();
        $ref->first_name = $input['firstName'];
        $ref->middle_name = $input['middleName'];
        $ref->other_names = $input['otherNames'];
        $ref->occupation = $input['occupation'];
        $ref->email = $input['email'];
        $ref->phone_no = $input['phoneNo'];
        $ref->relationship = $input['relationship'];
        $ref->lenght_of_relationship = $input['lengthOfRelationship'];
        $ref->user_id = $user->id;
        auth()->user()->referees()->save($ref);

        return ['referee'=> $ref, 'message'=> 'Saved successfully.'];
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
