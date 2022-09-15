@extends('theme.base')

@section('content')
    <div class="container py-5 text-center">
        <h1>Listado de clientes</h1>
        
        <a href="{{ route('client.create') }}" class="btn btn-primary">Crear Clientes</a>

        @if (Session::has('mensaje'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{Session::get('mensaje')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    
    <div class="shadow p-3 mb-5 bg-body rounded-3 container py-5 text-center">
        
        <table class="table display nowrap" cellspacing="0" width="100%">
            <thead class="bg-dark text-white">
                <th>Nombre</th>
                <th>Saldo</th>
                <th>Comentarios</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @forelse ($clients as $detail)
                    <tr>
                        <td>{{$detail->name}}</td>
                        <td>{{$detail->due}}</td>
                        <td>{{$detail->comments}}</td>
                        <td>
                            <a href="{{route('client.edit',$detail)}}" class="btn btn-warning">Editar</a>

                            <form action="{{ route('client.destroy', $detail) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar este cliente?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <td colspan="3">NO HAY REGISTROS</td>
                @endforelse           
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            @if ($clients->count())
                {{$clients->links()}}
            @endif
        </div>        
    </div>
@endsection