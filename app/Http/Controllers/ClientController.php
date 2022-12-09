<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function __construct()

    {
        $this->middleware('auth');
        $this->middleware(['role:ROLE_ADMIN, ROLE_PREPOSE_CLIENTS_AFFAIRES, ROLE_PREPOSE_CLIENTS_RESIDENTIELS']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //$clients = Client::all()->toArray();


        if (auth()->user()->hasRole('ROLE_ADMIN')) {
            $clients = DB::table('clients')
                ->join('client_type', 'clients.id', '=', 'client_type.client_id')
                ->join('types', 'client_type.type_id', '=', 'types.id')
                ->get(['clients.id', 'clients.first_name', 'clients.last_name', 'types.name']);

            return view('client.index', compact('clients'));

        } else if (auth()->user()->hasRole('ROLE_PREPOSE_CLIENTS_AFFAIRES')) {
            $clients = DB::table('clients')
                ->join('client_type', 'clients.id', '=', 'client_type.client_id')
                ->join('types', 'client_type.type_id', '=', 'types.id')
                ->where('types.name', '=', 'CLIENT_AFFAIRES')
                ->get(['clients.id', 'clients.first_name', 'clients.last_name', 'types.name']);

            return view('client.index', compact('clients'));

        } else if (auth()->user()->hasRole('ROLE_PREPOSE_CLIENTS_RESIDENTIELS')) {
            $clients = DB::table('clients')
                ->join('client_type', 'clients.id', '=', 'client_type.client_id')
                ->join('types', 'client_type.type_id', '=', 'types.id')
                ->where('types.name', '=', 'CLIENT_RESIDENTIEL')
                ->get(['clients.id', 'clients.first_name', 'clients.last_name', 'types.name']);

            return view('client.index', compact('clients'));

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $types = DB::table('types')
            -> get(['id', 'name']);

        return view('client.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'client-type' => 'required',
        ]);

        $client_type_name = DB::table('types')
            ->where("id","=",$request['client-type'])
            ->get('name');

//        $client = new client([
//            'first_name' => $request->get('first_name'),
//            'last_name' => $request->get('last_name')
//        ]);
//        $client->save();

        if ((auth()->user()->hasRole('ROLE_ADMIN'))||
            ((auth()->user()->hasRole('ROLE_PREPOSE_CLIENTS_AFFAIRES'))&&($client_type_name=='CLIENT_AFFAIRES'))||
            ((auth()->user()->hasRole('ROLE_PREPOSE_CLIENTS_RESIDENTIELS'))&&($client_type_name=='CLIENT_RESIDENTIEL'))){

            $client_id = DB::table('clients')-> insertGetId([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            DB::table('client_type')->insert([
                'type_id' => $request['client-type'],
                'client_id' => $client_id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            return redirect()->route('client.index')->with('success', 'Client ajouté');
        }else{
            Log::info("L'utilisateur ".auth()->user()." a essayé d'ajouter un client non attribué");
            return redirect()->route('client.index')->with('error', "Vous n'avez pas les droits pour ajouter ce type de client !");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);

        if ((auth()->user()->hasRole('ROLE_ADMIN'))||
            ((auth()->user()->hasRole('ROLE_PREPOSE_CLIENTS_AFFAIRES'))&&($client->client_type('CLIENT_AFFAIRES')))||
            ((auth()->user()->hasRole('ROLE_PREPOSE_CLIENTS_RESIDENTIELS'))&&($client->client_type('CLIENT_RESIDENTIEL')))) {

            $type_id = DB::table('client_type')
                ->where("client_id", "=", $id)
                ->select('type_id')
                ->first();

            $types = DB::table('types')
                -> get(['id', 'name']);

            return view('client.edit', compact('client', 'id', 'type_id', 'types'));
        }else{
            Log::info("L'utilisateur ".auth()->user()." a essayé d'accéder à un client non attribué");
            return $this->index();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'client-type' => 'required',
        ]);

        $client = client::find($id);

        if ((auth()->user()->hasRole('ROLE_ADMIN'))||
            ((auth()->user()->hasRole('ROLE_PREPOSE_CLIENTS_AFFAIRES'))&&($client->client_type('CLIENT_AFFAIRES')))||
            ((auth()->user()->hasRole('ROLE_PREPOSE_CLIENTS_RESIDENTIELS'))&&($client->client_type('CLIENT_RESIDENTIEL')))) {

            $client->first_name = $request->get('first_name');
            $client->last_name = $request->get('last_name');
            $client->save();

            DB::table('client_type')
                ->where('client_id', '=', $id)
                ->update([
                'type_id' => $request['client-type'],
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            return redirect()->route('client.index')->with('success', 'Client modifié');
        }else{
            Log::info("L'utilisateur ".auth()->user()." a essayé d'ajouter un client non attribué");
            return redirect()->route('client.index')->with('error', "Vous n'avez pas les droits pour faire cela");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $client = Client::find($id);

//        $client_type = DB::table('client_type')
//            ->where('client_id', '=', $id)
//            ->join('types', 'client_type.id', '=', 'types.id')
//            ->select('types.names')
//            ->get();

        if (auth()->user()->hasRole('ROLE_ADMIN')) {

            $client->delete();
            return redirect()->route('client.index')->with('success', 'Client supprimé');

        } else if (($client->client_type('CLIENT_AFFAIRES')) && (auth()->user()->hasRole('ROLE_PREPOSE_CLIENTS_AFFAIRES'))) {

            $client->delete();
            return redirect()->route('client.index')->with('success', 'Client supprimé');

        } else if (($client->client_type('CLIENT_RESIDENTIEL')) && (auth()->user()->hasRole('ROLE_PREPOSE_CLIENTS_RESIDENTIELS'))) {

            $client->delete();
            return redirect()->route('client.index')->with('success', 'Client supprimé');
        } else {
            Log::info("L'utilisateur ".auth()->user()." a essayé de supprimer un client non attribué");
            return redirect()->route('client.index')->with('error', "Vous n'avez pas les droits");
        }


    }
}
