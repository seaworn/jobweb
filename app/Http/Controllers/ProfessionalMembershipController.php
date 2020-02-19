<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfessionalMembership;

class ProfessionalMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->professional_memberships;
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
        $user = auth()->user();
        $pm = new ProfessionalMembership();
        $pm->professional_body = $input['professionalBody'];
        $pm->reg_no = $input['regNo'];
        $pm->membership_type = $input['membershipType'];
        $pm->expiry = $input['expiry'];
        $pm->user_id = $user->id;
        $pm->save();

        return ['membership'=> $pm, 'message'=> 'Saved successfully.'];
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
