@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">{{ $category->name }}</div>
                    <div class="panel-body">
                        <div class="col-md-8">
                            Description: <p>{{ $category->description }}</p>
                        </div>
                        <div class="col-md-4">
                            @if(count($category->lessons))
                                @foreach($category->lessons as $lesson)
                                    <section class="row">
                                        <a href="{{ url('/lessons', ['lessonID' => $lesson->id]) }}">{{ $lesson->name }}</a>
                                    </section>
                                @endforeach
                            @else
                                This category have not lesson yet!
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
