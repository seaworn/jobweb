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
        $input = $request->validate([
            'first_name' => '',
            'middle_name' => '',
            'other_names' => '',
            'occupation' => '',
            'email' => '',
            'phone_no' => '',
            'relationship' => '',
            'length_of_relationship' => ''
        ]);
        $ref = Referee::create(array_merge($input, ['user_id' => auth()->user()->id]));
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
        Referee::destroy($id);
        return ['message' => 'Deleted successfully.'];
    }
}
