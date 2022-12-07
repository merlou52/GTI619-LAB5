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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
