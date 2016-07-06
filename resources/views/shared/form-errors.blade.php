@if(count($errors))
    <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>You have {{ count($errors->all()) }} error: </strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
