@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Account Setting</div>

                    <div class="panel-body">
                        <div class="col-md-6 col-md-offset-3">
                            @include('shared.form-errors')
                            @if(session()->has('flash_message'))
                                <div class="alert alert-{{ session('flash_message_type') }}">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                    <p>{{ session()->get('flash_message') }}</p>
                                </div>
                            @endif
                            {!! Form::open(array('url' => '/users/' . $user->id, 'method' => 'put', 'files' => true)) !!}
                            <div class="form-group">
                                {!! Form::label('name') !!}
                                {!! Form::text('name', $user->name, array('class' => 'form-control', 'id' => 'name')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password') !!}
                                {!! Form::password('password', array('class' => 'form-control', 'id' => 'password')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password_confirmation') !!}
                                {!! Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password_confirmation')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Image') !!}
                                {!! Form::file('image', ['class' => 'form-control', 'id' => 'image']) !!}
                            </div>
                            {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
                            {!! Form::close() !!}
                            <section class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <img src="{{ $user->avatar }}" alt="" class="img-responsive">
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
