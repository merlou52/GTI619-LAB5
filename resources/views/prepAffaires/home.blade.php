@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard du préposé aux clients affaires</div>

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
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
