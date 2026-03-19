<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // 1. index() — listar todos (Proporcionado por el documento)
    public function index() {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    // 2. create() — mostrar formulario de creación (Completado)
    public function create() {
        // Solo necesita retornar la vista del formulario vacío
        return view('productos.create');
    }

    // 3. store() — guardar nuevo (Proporcionado por el documento)
    public function store(Request $request) {
        Producto::create($request->all());
        return redirect()->route('productos.index');
    }

    
    public function show(Producto $producto) {
        
    }

    // edit() — mostrar formulario de edición 
    public function edit(Producto $producto) {
        // Retorna la vista de edición pasándole el producto que se va a editar
        return view('productos.edit', compact('producto'));
    }

    // update() — actualizar en la base de datos 
    public function update(Request $request, Producto $producto) {
        $producto->update($request->all());
        return redirect()->route('productos.index');
    }

    // destroy() — eliminar de la base de datos 
    public function destroy(Producto $producto) {
        $producto->delete();
        return redirect()->route('productos.index');
    }
}