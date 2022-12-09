<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CreateNewUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:ROLE_ADMIN, null, null']);
    }

    public function index()
    {
        $roles = DB::table('roles')
            -> get(['id', 'name']);

        return view('admin.usercreate', compact('roles'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $minCharPass = DB::table("configuration")->first()->minChar?"min:".DB::table("configuration")->first()->minChar:"min:8";
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', $minCharPass, 'confirmed'],
            'user-level' => ['required', 'integer'],
        ]);
    }

    public function create(Request $request)
    {
        $this->validator($request->all())->validate();
        Log::info("L'utilisateur ".$request['name']." avec le courriel ".$request['email']." à été créer à ". date("Y-m-d H:i:s"));

        $uid = DB::table('users')-> insertGetId([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'remember_token' => Str::random(20),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('role_user')->insert([
            'role_id' => $request['user-level'],
            'user_id' => $uid,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        Log::info("L'utilisateur ".$request['name']." avec le courriel ".$request['email']." à été créé à ". date("Y-m-d H:i:s")." par ".auth()->user());

        return redirect()->route('home')->with('success', 'Nouvel utilisateur ajouté avec succès !');
    }
}
