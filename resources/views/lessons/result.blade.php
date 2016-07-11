@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">Result of lesson</div>
                    <div class="panel-body">
                        @if(count($lesson_words))
                        <h2>{{ $lesson_words->first()->lesson->name}}</h2>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Word status</th>
                                <th>Word title</th>
                                <th>Relearn</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lesson_words as $lessonWord)
                            <tr>
                                <td> {{ $lessonWord->wordAnswer->correct ? 'Pass' : 'Fail' }}</td>
                                <td> {{ $lessonWord->word->content }}</td>
                                <td><a href="{{ url('words', ['id' => $lessonWord->word->id]) }}">{{ $lessonWord->word->content}}</a> </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $lesson_words->links() }}
                        @else 
                            <h2>You haven't learned this lesson</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
