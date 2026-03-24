<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
</head>
<body>
    <h1>Gestión de Productos</h1>
        <div style="text-align: right; margin-bottom: 20px;">
    <span>Bienvenido, <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->rol }})</span>
    
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm" style="margin-left: 10px;">
            Cerrar Sesión
        </button>
    </form>
</div>
    
    <a href="{{ route('productos.create') }}">Crear Nuevo Producto</a>
    <br><br>

    <div class="row mb-3">
    <div class="col-md-6">
        <form method="GET" action="{{ route('productos.index') }}" class="d-flex">
            <input type="text" name="search" 
            value="{{ $search ?? '' }}" 
            class="form-control me-2" 
            placeholder="Buscar por nombre o descripción...">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary ms-2">Limpiar</a>
        </form>
    </div>
</div>



    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->categoria->nombre ?? 'Sin categoria '}}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->stock }}</td>
                <td>
                    <a href="{{ route('productos.edit', $producto->id) }}">Editar</a>
                    
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
                <td>
                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" width="60">
                    @else
                        <span>Sin imagen</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
    {{ $productos->appends(['search' => $search])->links() }}

    <p class="text-muted">
        Mostrando {{ $productos->count() }} de {{ $productos->total() }} productos
    </p>
</div>
</body>
</html>