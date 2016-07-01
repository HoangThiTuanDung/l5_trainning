@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    @if(session()->has('flash_message'))
                        <div class="alert alert-{{ session('flash_message_type') }}">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                            <p>{{ session()->get('flash_message') }}</p>
                        </div>
                    @endif
                    {!! Form::open(array('url' => '/login', 'class' => 'form-horizontal')) !!}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::label('email', 'E-Mail Address', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::email('email', old('email'), array('class' => 'form-control', 'id' => 'email')) !!}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        {!! Form::label('password', 'Password', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::password('password', array('class' => 'form-control', 'id' => 'password')) !!}
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-sign-in"></i> Login
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <a class="btn btn-link" href="{{ url('/register') }}">Create new account</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
