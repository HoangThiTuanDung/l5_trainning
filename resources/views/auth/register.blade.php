@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    {!! Form::open(array('url' => '/register', 'class' => 'form-horizontal', 'files' => true)) !!}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Name', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::text('name', old('name'), array('class' => 'form-control', 'id' => 'name')) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::label('email', 'E-Mail', array('class' => 'col-md-4 control-label')) !!}
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

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        {!! Form::label('password-confirm', 'Confirm Password', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password-confirm')) !!}
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::label('image', 'Image', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::file('image', ['class' => 'form-control', 'id' => 'image']) !!}
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> Register
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
