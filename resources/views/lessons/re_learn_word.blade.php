@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">
                                {{ $word->lesson->name }}
                            </div>
                            <div class="col-md-4">
                                <p>{{ $word->content }}</p>
                            </div>
                            <div class="col-md-3 word-answers">
                                @foreach($word->wordAnswers as $answer)
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions" value="{{ $answer->id }}" class="answer-option"> {{ $answer->content }}
                                    </label>
                                    <br>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-md-offset-10">
                                <button class="btn btn-warning btn-next-word" data-word-number="0" data-type="re-learn" data-lesson-id="{{ $word->lesson->id }}" data-word-id="{{ $word->id }}">Save & Next Word</button>
                            </div>
                        </div>
                        <hr/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
