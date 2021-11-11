@extends('base')

@section('content')
<h1>{{ $enterprise }}</h1>
<form action="{{ url('resource') }}">
    
    <input value="{{ $resource['id'] }}" type="number"  placeholder="#id positive integer"  disabled />
    <input value="{{ $resource['name'] }}" type="text"  placeholder="Name of the resource" disabled />
    <input value="{{ $resource['precio'] }}" type="number"  placeholder="Price of the resource" step="any" disabled />
    <input type="submit" value="Back"/>
</form>

<table class="table table-striped"> 
    <thead>
        <tr>
            <th scope="col">
                # id
            </th>
            <th scope="col">
                Producto
            </th>
            <th scope="col">
                Precio
            </th>
        </tr>
        
    </thead>
    
    <tbody>
        <tr>
            <td>
                {{ $resource ['id'] }}
            </td>
            <td>
                {{ $resource ['name'] }}
            </td>
            <td>
                {{ $resource ['precio'] }}€
            </td>
            
            <td>
                <a href="{{ url('resource') }}"></a>
            </td>
        </tr>
    </tbody>
</table>
@endsection