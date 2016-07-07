@if(count($lesson->words) > 0)
    <div class="row">
        <div class="col-md-2">
            {{ $lesson->name }} - {{ $wordNumber + 1}}/{{ $totalWord }}
        </div>
        <div class="col-md-4">
            <p>{{ $lesson->words->first()->content }}</p>
        </div>
        <div class="col-md-3 word-answers">
            @foreach($lesson->words->first()->wordAnswers as $answer)
                <label class="radio-inline">
                    <input type="radio" name="inlineRadioOptions" value="{{ $answer->id }}" class="answer-option"> {{ $answer->content }}
                </label>
                <br>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-10">
            <button class="btn btn-warning btn-next-word" data-word-number="{{ $wordNumber }}" data-lesson-id="{{ $lesson->id }}" data-word-id="{{ $lesson->words->first()->id }}">Save & Next Word</button>
        </div>
    </div>
    <hr/>
@else
    <p>This lesson have not word yet!</p>
@endif
