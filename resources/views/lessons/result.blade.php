@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">lesson title</div>
                    <div class="panel-body">
                        <h2>{{ $lesson_words->first()->word->category->name }}</h2>
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
                                <td> {{ $lessonWord->wordAnswer->correct ? 'pass' : 'fail' }}</td>
                                <td> {{ $lessonWord->word->content }}</td>
                                <td>{{ $lessonWord->wordAnswer->correct ? '' : link_to_route('lessons.re_learn', $lessonWord->word->content, $lessonWord->word->id) }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $lesson_words->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
