<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function create(Request $request) {
        $this->validate($request, [
            'personalInfo.firstName' => 'Required',
            'personalInfo.middleName' => 'Required',
            'personalInfo.otherName' => 'Required',
            'personalInfo.email' => 'Required|email'
        ]);
    }
}
