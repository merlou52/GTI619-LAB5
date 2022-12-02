<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user-level' => ['required', 'integer'],
        ]);
    }

    public function create(Request $request)
    {
        $this->validator($request->all())->validate();

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

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect('/admin');
    }
}
