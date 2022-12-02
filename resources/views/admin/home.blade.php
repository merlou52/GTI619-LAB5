@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div align="left">
                                <br />
                                <a href="{{route('client.index')}}" class="btn btn-primary">Accéder aux clients</a>
                                <br />
                                <br />
                                <a href="{{route('admin.usercreate')}}" class="btn btn-danger">Ajouter un nouvel utilisateur</a>
                                <br />
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
