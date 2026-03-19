<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Producto</title>
</head>
<body>
    <h1>Nuevo Producto</h1>

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

    <form method="POST" action="{{ route('productos.store') }}">
        @csrf
        
        <div>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre" required value="{{ old('nombre') }}">
            @error('nombre')
                <br><span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <br>
        <div>
            <label for="descripcion">Descripción:</label><br>
            <textarea id="descripcion" name="descripcion" placeholder="Descripción del producto" >{{ old('descripcion') }}</textarea>
        </div>
        <br>
        <div>
            <label for="precio">Precio:</label><br>
            <input type="number" step="0.01" id="precio" name="precio" placeholder="Precio" required value="{{ old('precio') }}">
            @error('precio')
                <br><span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <br>
        <div>
            <label for="stock">Stock:</label><br>
            <input type="number" id="stock" name="stock" placeholder="Stock" required value="{{ old('stock') }}">
            @error('stock')
                <br><span style="color:red;">{{ $message }}</span>
            @enderror
        </div>
        <br>
        
        <button type="submit">Guardar</button>
    </form>
</body>
</html>