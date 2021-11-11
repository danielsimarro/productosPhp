@extends('base')

@section('content')


<div class="modal" id="modalDelete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Confirm delete?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="modalDeleteResourceForm" action="" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Delete resource"/>
        </form>
      </div>
    </div>
  </div>
</div>


<h1>{{ $enterprise }}</h1>

@isset($message)
    <div class="alert alert-{{ $type }}" role="alert">
        {{ $message }}
    </div>
@endisset

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col"># id</th>
            <th scope="col">Producto</th>
            <th scope="col">Precio</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($resources as $resource)
            <tr>
                <td>
                    {{ $resource['id'] }}
                </td>
                <td>
                    {{ $resource['name'] }}
                </td>
                <td>
                    {{ $resource['precio'] }}€
                </td>
                
                <td>
                    <form action="{{url('resource/' . $resource['id'])}}">
                    <input type="submit" value="Show"/>
                    </form>
                </td>
                <td>
                    <form action="{{ url('resource/' . $resource['id'] . '/edit') }}">
                    <input type="submit" value="Edit"/>
                    </form>
                    <!--<a href="{{ url('resource/' . $resource['id'] . '/edit') }}">edit</a>-->
                    <!--<a href="{{ route('resource.edit', $resource['id']) }}">edit</a>
                    <a href="{{ action([App\Http\Controllers\ResourceController::class, 'edit'], $resource['id']) }}">edit</a>-->
                </td>
                <td>
                  <!-- nuevo 2 -->
                    <form class="deleteForm" action="{{ url('resource/' . $resource['id']) }}" method="post">
                        @method('delete')
                        @csrf
                        <input type="submit" value="Delete"/>
                    </form>
                    <!--<a href="#" data-url="{{ url('resource/' . $resource['id'])}}" class="deleteLink" >delete 2</a><br>
                    <a href="javascript: void(0);" data-url="{{ url('resource/' . $resource['id']) }}" data-bs-toggle="modal" data-bs-target="#modalDelete">delete 3</a>-->
                    <!-- fin nuevo 2 -->
                    
                </td>
                
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ url('resource/create') }}" class="btn btn-primary btn-lg" type="button">Add new resource</a>
<a href="{{ url('resource/flush/all') }}" class="btn btn-danger btn-lg" type="button">Delete all resources</a>
<form id="deleteResourceForm" action="" method="post">
    @method('delete')
    @csrf
</form>
@endsection


@section('js')
<!-- nuevo 4 -->
<script src="{{ url('assets/js/delete.js') }}"></script>
<!-- nuevo 4 -->
@endsection