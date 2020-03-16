<?php

namespace App\Http\Controllers;

use App\ContractType;
use Illuminate\Http\Request;

class ContractTypeController extends Controller
{
    public function index()
    {
        return ContractType::get();
    }
}
