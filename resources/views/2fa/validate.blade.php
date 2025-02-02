@extends('layouts.app')

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">2FA</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="/2fa/validate">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('totp') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Saisir votre clé Google Authenticator</label>
                                <br>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="totp">

                                    @if ($errors->has('totp'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('totp') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-mobile"></i>Valider
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
