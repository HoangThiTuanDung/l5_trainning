@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @if(session()->has('flash_message'))
                        <div class="alert alert-{{ session('flash_message_type') }}">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                            <p>{{ session()->get('flash_message') }}</p>
                        </div>
                    @endif
                    <div class="col-md-3">
                        <img src="{{ $user->avatar }}" alt="" class="img-responsive">
                        <div class="row">
                            <span>{{ $user->name }}</span>
                        </div>
                        <div class="row">
                            <span>Learned - {{ $totalLearned }} {{ $totalLearned > 1 ? 'words' : 'word' }}</span>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <section class="row">
                            <a class="btn btn-info btn-lg" href="#" role="button">Words</a>
                            <a class="btn btn-info btn-lg" href="#" role="button">Lesson</a>
                        </section>
                        <section class="row">
                            <h2>Activities</h2>
                            <hr>
                            @foreach($activities as $activity)
                                <p>Learned {{ $activity->words_numbers }} words in Lesson "{{ $activity->lesson->name }}" - ({{$activity->created_at->format('Y/m/d')}})</p>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
