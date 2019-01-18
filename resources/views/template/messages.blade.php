@if(session('success'))
    <div class="alert alert-success">
        <p> {{ session('success') }} </p>
    </div>
@endif
@if(isset($errors))
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <p>{{ $error }}</p>
        </div>
    @endforeach
@endif
