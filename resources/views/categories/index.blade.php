@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">List Categories</div>
                    <div class="panel-body">
                        @if(count($categories))
                            @foreach($categories as $cate)
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="panel-heading">
                                        <h3>{{ $cate->name }}</h3>
                                        <span>{{ trans('messages.word_learned', ['word_number' => $cate->wordsCorrect(Auth::id(), $cate->id, 1), 'total_words' => $cate->words->count()]) }}</span>
                                    </div>
                                    <div class="panel-body">
                                        <p>{{ $cate->description }}</p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ url('/categories', ['category' => $cate->id]) }}" role="button" class="btn btn-primary">Start</a>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
