@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{$message}}</p>
                            </div>
                        @endif

                        <div align="left">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Authentification double-facteur</div>

                                        <div class="panel-body">
                                            @if (Auth::user()->google2fa_secret)
                                                <a href="{{ url('2fa/disable') }}" class="btn btn-warning">Désactiver 2FA</a>
                                            @else
                                                <a href="{{ url('2fa/enable') }}" class="btn btn-primary">Activer la 2FA</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br/>
                            <a href="{{route('client.index')}}" class="btn btn-primary">Accéder aux clients</a>
                            <br/>
                            <br/>

                            @if(auth()->user()->hasRole('ROLE_ADMIN'))
                                <a href="{{route('admin.usercreate')}}" class="btn btn-danger">Ajouter un nouvel
                                    utilisateur</a>
                                <br/>

                                <h3>Configuration de sécurité</h3>
                            <form method="post" action="{{url('')}}">
                                {{csrf_field()}}
                                <div>
                                    <h4>Protection d'attaque</h4>
                                <p>Nombre de connection maximale
                                    <input type="number" name = "connectionLimit">
                                </p>
                                <p>délais
                                    <input type="number" name = "delay">
                                </p>
                                <p>bloquage d'acces
                                    <input type="checkbox" name = "accessBlocker">
                                </p>
                                </div>

                                <div>
                                    <h4>Norme de mot de passe</h4>
                                    <p>Nombre de caractère minimal
                                        <input type="number" name = "minChar">
                                    </p>
                                    <p>Nombre de mot de passe innutilisable
                                        <input type="number" name = "numberOfSavedPassword">
                                    </p>
                                </div>

                                <div>
                                    <h4>Gestion de mot de passe</h4>
                                    <p>Changement périodique (en jours)
                                        <input type="number" name = "numberOfDayBeforeChange">
                                    </p>
                                    <p>Forcé le changement de mot de passe si limite excédé
                                        <input type="checkbox" name = "forceChangeIfCompromised">
                                    </p>
                                </div>

                                <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            </form>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
