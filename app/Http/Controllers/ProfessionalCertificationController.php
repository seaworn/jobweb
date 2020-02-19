<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfessionalCertification;

class ProfessionalCertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->professional_certifications;
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
        $pc = new ProfessionalCertification();
        $pc->certificate_name = $input['certificateName'];
        $pc->issuing_body = $input['issuingBody'];
        $pc->description = $input['description'];
        $pc->issued_on = $input['issuedOn'];
        $pc->expiry = $input['expires'] ? $input['expiry'] : null;
        $file = $request->file('file');
        $path = $file->store('uploads');
        $pc->file_path = $path;
        auth()->user()->professional_certifications()->save($pc);
        return ['certificate'=> $pc, 'message'=> 'Saved successfully.'];
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
