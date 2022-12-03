@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <br/>
            <h3 aling="center">Ajouter un client</h3>
            <br/>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif

            <form method="post" action="{{url('client')}}">
                {{csrf_field()}}

                    <div class="col-md-6">
                        <input type="text" name="first_name" class="form-control" placeholder="Enter First Name"/>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name"/>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <select name="client-type" id="client-type" class="form-control">
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary"/>
                    </div>

            </form>
        </div>
@endsection
