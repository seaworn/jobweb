<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Profile, User};

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        // $this->authorize('create', Profile::class);
        $input = $request->validate([
            'first_name'=> '',
            'middle_name' => '',
            'other_names' => '',
            'dob' => '',
            'gender' => '',
            'nationality' => '',
            'county' => '',
            'sub_county' => '',
            'address' => '',
            'phone_no' => '',
            'disability' => '',
            'criminal_record' => ''
        ]);
        $pi = new Profile($input);
        auth()->user()->personalInformation()->save($pi);
        return ['message'=> 'Saved successfuly.'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // $this->authorize('view');
        return auth()->user()->personalInformation;
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
        // $this->authorize('update', $id);
        Profile::whereId($id)->update($request->all());
        return ['message'=> 'Updated successfully.'];
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
