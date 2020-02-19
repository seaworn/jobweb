<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalInformation;
use App\ContactPerson;

class PersonalInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['info'=> auth()->user()->personal_information];
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
        //     'firstName'=> 'required|alpha|min:2'
        // ]);
        $input = $request->all();
        $user = auth()->user();

        $pi = new PersonalInformation();
        $pi->first_name = $input['firstName'];
        $pi->middle_name = $input['middleName'];
        $pi->other_names = $input['otherNames'];
        $pi->dob = $input['dob'];
        $pi->gender = $input['gender'];
        $pi->nationality = $input['nationality'];
        $pi->county =  $input['county'];
        $pi->sub_county = $input['subCounty'];
        $pi->address = $input['address'];
        $pi->phone_no = $input['phoneNo'];
        $pi->disability = $input['disability']['has'] ? $input['disability']['details'] : null;
        $pi->criminal_record = $input['criminalRecord']['has'] ? $input['criminalRecord']['details'] : null;
        $pi->user_id = $user->id;
        $pi->save();

        $cp = new ContactPerson();
        $cpi = $input['contactPerson'];
        $cp->first_name = $cpi['firstName'];
        $cp->middle_name = $cpi['middleName'];
        $cp->other_names = $cpi['otherNames'];
        $cp->phone_no = $cpi['phoneNo'];
        $cp->email = $cpi['email'];
        $cp->user_id = $user->id;
        $cp->save();

        return [
            'personal_info'=> ['personal'=> $pi, 'contact_person'=> $cpi],
            'message'=> 'Saved successfuly.'
        ];
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
