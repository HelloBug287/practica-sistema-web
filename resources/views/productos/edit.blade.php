<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>
    @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="{{ route('productos.index') }}">Volver al listado</a>
    <br><br>

    <form method="POST" action="{{ route('productos.update', $producto->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
            @error('nombre')
                <br><span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <br>

        <div>
            <label>Categoría:</label><br>
            <select name="categoria_id" required>
                @foreach($categorias as $cat)
                <option value="{{ $cat->id }}" {{ old('categoria_id', $producto->categoria_id) == $cat->id ? 'selected' : '' }}>
                    {{ $cat->nombre }}
                </option>
                @endforeach
            </select>
        </div>
        <br>

        <div>
            <label for="descripcion">Descripción:</label><br>
            <textarea id="descripcion" name="descripcion">{{ old('descripcion', $producto->descripcion) }}</textarea>
            @error('descripcion')
                <br><span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <br>

        <div>
            <label for="precio">Precio:</label><br>
            <input type="number" step="0.01" id="precio" name="precio" value="{{ old('precio', $producto->precio) }}" required>
            @error('precio')
                <br><span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <br>
        
        <div>
            <label for="stock">Stock:</label><br>
            <input type="number" id="stock" name="stock" value="{{ old('stock', $producto->stock) }}" required>
            @error('stock')
                <br><span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <br>
        
        <button type="submit">Actualizar Producto</button>
    </form>
</body>
</html>