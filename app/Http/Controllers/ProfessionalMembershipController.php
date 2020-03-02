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
        return auth()->user()->professionalMemberships;
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
            'professional_body' => '',
            'reg_no' => '',
            'membership_type' => '',
            'expiry.expires' => '',
            'expiry.when' => ''
        ]);
        $pm = ProfessionalMembership::create(array_merge($input, ['user_id' => auth()->user()->id]));
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
        ProfessionalMembership::destroy($id);
        return ['message' => 'Deleted successfully.'];
    }
}
