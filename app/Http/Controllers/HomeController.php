<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:ROLE_ADMIN, ROLE_PREPOSE_CLIENTS_AFFAIRES, ROLE_PREPOSE_CLIENTS_RESIDENTIELS']);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function saveConfiguration(Request $request)
    {
        if (auth()->user()->hasRole('ROLE_ADMIN')) {
            $config = DB::table('configuration')->first();
            if ($config == null) {
                DB::table('configuration')->insert([
                    'connectionLimit' => $request->input("connectionLimit"),
                    'delay' => $request->input("delay"),
                    'accessBlocker' => $request->input("accessBlocker")??false,
                    'minChar' => $request->input("minChar"),
                    'numberOfSavedPassword' => $request->input("numberOfSavedPassword"),
                    'numberOfDayBeforeChange' => $request->input("numberOfDayBeforeChange"),
                    'forceChangeIfCompromised' => $request->input("forceChangeIfCompromised")??false
                ]);
            } else {
                DB::table('configuration')->where(1, $config->id)->update([
                    'connectionLimit' => $request->input("connectionLimit"),
                    'delay' => $request->input("delay"),
                    'accessBlocker' => $request->input("accessBlocker"),
                    'minChar' => $request->input("minChar"),
                    'numberOfSavedPassword' => $request->input("numberOfSavedPassword"),
                    'numberOfDayBeforeChange' => $request->input("numberOfDayBeforeChange"),
                    'forceChangeIfCompromised' => $request->input("forceChangeIfCompromised")
                ]);
            }

            return view('home');
        }
        return view('home');
    }
}
