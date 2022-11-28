<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleAssociationController extends Controller
{
    public function __construct()

    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_ADMIN');
    }

    public function index()
    {
        // on récupère les rôles possibles en bd
        $roles = Role::all();
        //TODO faire de même avec les users (utiliser compact)
        return view('admin.role', $roles);
    }
}
