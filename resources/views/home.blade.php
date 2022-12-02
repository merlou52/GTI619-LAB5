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
