<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Requests\ProductRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    // index() — listar todos 
    public function index(Request $request) {
        $search = $request->input('search');

        $productos = Producto::with('categoria')
        ->when($search, function ($query, $search){
            $query->where('nombre', 'LIKE', '%' . $search . '%')
            ->orWhere('descripcion', 'LIKE', '%' . $search . '%');
            })
            ->paginate(10);
        return view('productos.index', compact('productos', 'search'));
    }

    // create() — mostrar formulario de creación 
    public function create() {
        // Solo necesita retornar la vista del formulario 
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    // store() — guardar nuevo 
    public function store(ProductRequest $request) {
        $data = $request->all();

        if ($request->hasFile('imagen')){
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create($data);
        return redirect()->route('productos.index')
                ->with('success', 'Producto creado exitosamente.');
    }

    
    public function show(Producto $producto) {
        
    }

    // edit() — mostrar formulario de edición 
    public function edit(Producto $producto) {
        $categorias = Categoria::all();
        // Retorna la vista de edición pasándole el producto que se va a editar
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // update() — actualizar en la base de datos 
    public function update(ProductRequest $request, Producto $producto) {
        $data = $request->all();

        if ($request->hasFile('imagen')) {
            if ($producto->imagen){
                Storage::disk('public')->delete($producto->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }
        $producto->update($data);
        return redirect()->route('productos.index')
                ->with('success', 'Producto actualizado exitosamente.');
    }

    // destroy() — eliminar de la base de datos 
    public function destroy(Producto $producto) {
        if ($producto->imagen){
            Storage::disk('public')->delete($producto->imagen);
        }
        $producto->delete();
        return redirect()->route('productos.index')
                ->with('success', 'Producto eliminado exitosamente.');
    }
}