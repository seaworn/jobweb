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
        return auth()->user()->professionalCertifications;
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
            'certificate_name' => '',
            'issuing_body' => '',
            'description' => '',
            'issued_on' => '',
            'expires' => '',
            'expiry' => '',
            'attachment' => ''
        ]);
        $input = collect($input);
        $pc = new ProfessionalCertification($input->only([
            'certificate_name',
            'issuing_body',
            'description',
            'issued_on',
            'expiry'
        ])->all());
        $pc->attachment_filepath = $request->file('attachment')->store('uploads');
        auth()->user()->professionalCertifications()->save($pc);
        return ['certification'=> $pc, 'message'=> 'Saved successfully.'];
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
        ProfessionalCertification::destroy($id);
        return ['meaasge' => 'Certification deleted successfully.',];
    }
}
