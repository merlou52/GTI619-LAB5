@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <br/>
            <h3>Edit Record</h3>
            <br/>
            @if(count($errors) > 0)

                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form method="post" action="{{route('client.update',['id'=>  $id])}}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PATCH"/>
                        <div class="col-md-6">
                            <input type="text" name="first_name" class="form-control" value="{{$client->first_name}}"
                                   placeholder="Enter First Name"/>
                        </div>
                        <br>
                        <div class="col-md-6">
                            <input type="text" name="last_name" class="form-control" value="{{$client->last_name}}"
                                   placeholder="Enter Last Name"/>
                        </div>
                        <br>
                        <div class="col-md-6">
                            <select name="client-type" id="client-type" class="form-control">
                                @foreach($types as $type)
                                    <option @if($type->id == $type_id->type_id) selected @endif  value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-primary" value="Edit"/>
                        </div>
                    </form>
                </div>
        </div>

@endsection
