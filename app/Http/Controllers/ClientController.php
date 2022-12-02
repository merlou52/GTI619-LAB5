<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

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
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        $client = new client([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name')
        ]);
        $client->save();
        return redirect()->route('client.index')->with('success', 'Client ajouté');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return view('client.edit', compact('client', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        $client = client::find($id);
        $client->first_name = $request->get('first_name');
        $client->last_name = $request->get('last_name');
        $client->save();
        return redirect()->route('client.index')->with('success', 'Client modifié');
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

        } else if (($client->client_type('CLIENT_AFFAIRES')) && (auth()->user()->hasRole('ROLE_PREPOSE_CLIENTS_RESIDENTIELS'))) {

            $client->delete();
            return redirect()->route('client.index')->with('success', 'Client supprimé');
        } else {
            return redirect()->route('client.index')->with('error', "Vous n'avez pas les droits");
        }


    }
}
