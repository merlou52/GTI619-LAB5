<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrepResidentielController extends Controller
{
    public function __construct()

    {
        $this->middleware('auth');
        $this->middleware(['role:ROLE_ADMIN, null, ROLE_PREPOSE_CLIENTS_RESIDENTIELS']);
    }

    public function index()
    {
        return view('prepResidentiel.home');
    }
}
