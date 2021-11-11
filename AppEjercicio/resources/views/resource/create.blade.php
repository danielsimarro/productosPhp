@extends('base')

@section('content')
<h1>{{ $enterprise }}</h1>
@if(old('id') != '')
    <div class="alert alert-danger" role="alert">
        Error. Mira el ID.
    </div>
@endif
<form action="{{ url('resource') }}" method="post">
    @csrf
    <input value="{{ old('name') }}" type="text" name="name" placeholder="Name of the resource" min-length="5" max-length="30" required />
    <input value="{{ old('precio') }}" type="number" name="precio" placeholder="Price of the resource" step="any" required />
    <input type="submit" value="Create"/>
</form>

@endsection