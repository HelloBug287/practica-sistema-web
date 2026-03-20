<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Requests\ProductRequest;
use App\Models\Categoria;

class ProductoController extends Controller
{
    // index() — listar todos 
    public function index() {
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    // create() — mostrar formulario de creación 
    public function create() {
        // Solo necesita retornar la vista del formulario 
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    // store() — guardar nuevo 
    public function store(ProductRequest $request) {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string|max:500',
        ]);
        Producto::create($request->all());
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
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string|max:500',
        ]);
        $producto->update($request->all());
        return redirect()->route('productos.index')
                ->with('success', 'Producto actualizado exitosamente.');
    }

    // destroy() — eliminar de la base de datos 
    public function destroy(Producto $producto) {
        $producto->delete();
        return redirect()->route('productos.index')
                ->with('success', 'Producto eliminado exitosamente.');
    }
}