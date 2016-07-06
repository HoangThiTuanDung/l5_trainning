@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">WordList</div>
                        <div class="panel-body">
                            <section class="row">
                                <div class="col-md-10 col-md-offset-2" id="display-errors">

                                </div>
                            </section>
                            <section class="row">
                                <div class="col-md-3 col-md-offset-3">
                                    {!! Form::open(array('url' => 'words/search', 'id' => 'frm-search')) !!}
                                        {!! Form::label('category') !!}
                                        {!! Form::select('category', $categories, '', ['class' => 'form-control', 'id' => 'category']) !!}
                                        <div class="radio">
                                            <label>{!!  Form::radio('flag', 1, '', ['class' => 'flag']) !!} Learned</label>
                                        </div>
                                        <div class="radio">
                                            <label>{!!  Form::radio('flag', 0, '', ['class' => 'flag']) !!}Not Learned</label>
                                        </div>
                                        <div class="radio">
                                            <label>{!!  Form::radio('flag', 2, '', ['class' => 'flag']) !!}All</label>
                                        </div>
                                        {!! Form::submit('Filter', array('class' => 'btn btn-default', 'id' => 'btn-filter')) !!}
                                    {!! Form::close() !!}
                                </div>
                            </section>
                            <hr>
                            <section class="row">
                                <div class="col-md-9 col-md-offset-3" id="results">

                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
