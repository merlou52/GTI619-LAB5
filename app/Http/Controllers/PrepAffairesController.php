<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrepAffairesController extends Controller
{
    public function __construct()

    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_PREPOSE_CLIENTS_AFFAIRE');
        $this->middleware('role:ROLE_ADMIN');
    }

    public function index()
    {
        return view('prepAffaires.home');
    }
}
