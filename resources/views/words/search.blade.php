@if(isset($words) && count($words) > 0)
    <h3>Results</h3>
    @foreach($words as $word)
        <p>{{ $word->content }}</p>
    @endforeach
@else
    <p>Not found any word with your conditions</p>
@endif
