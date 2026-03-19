<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>
    <a href="{{ route('productos.index') }}">Volver al listado</a>
    <br><br>

    <form method="POST" action="{{ route('productos.update', $producto->id) }}">
        @csrf
        @method('PUT')
        
        <div>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" value="{{ $producto->nombre }}" required>
        </div>
        <br>
        <div>
            <label for="descripcion">Descripción:</label><br>
            <textarea id="descripcion" name="descripcion">{{ $producto->descripcion }}</textarea>
        </div>
        <br>
        <div>
            <label for="precio">Precio:</label><br>
            <input type="number" step="0.01" id="precio" name="precio" value="{{ $producto->precio }}" required>
        </div>
        <br>
        <div>
            <label for="stock">Stock:</label><br>
            <input type="number" id="stock" name="stock" value="{{ $producto->stock }}" required>
        </div>
        <br>
        
        <button type="submit">Actualizar Producto</button>
    </form>
</body>
</html>