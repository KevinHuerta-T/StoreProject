@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('productos.index') }}" method="GET">
                            <div class="form-group">
                                <label for="precio_min">Precio mínimo:</label>
                                <input type="number" name="precio_min" id="precio_min" class="form-control"
                                    value="{{ request('precio_min') ?? 0 }}">
                            </div>
                            <div class="form-group">
                                <label for="precio_max">Precio máximo:</label>
                                <input type="number" name="precio_max" id="precio_max" class="form-control"
                                    value="{{ request('precio_max') ?? 0 }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista de productos</div>
                    <div class="card-body">
                     @push('styles')
                            <style>
                                .pagination li a, .pagination li span {
                                    font-size: 0.9rem;
                                    padding: 0.5rem 0.75rem;
                                }
                            </style>
                        @endpush
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($productos as $producto)
                                    <tr>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>{{ $producto->descripcion }}</td>
                                        <td>{{ number_format($producto->precio, 2, ',', '.') }}</td>
                                        <td><a href="{{ route('productos.edit', $producto->id) }}"
                                                class="btn btn-primary">Editar</a></td>
                                        <td>
                                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No se encontraron productos</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $productos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
