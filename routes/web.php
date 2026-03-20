<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\LoginController;



//Rutas Públicas

// La raíz del sitio redirige automáticamente al Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de Autenticación 
Route::get('/login', [LoginController::class, 'index'])->name('login');
!Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



//Rutas Protegidas (Solo usuarios logueados)

Route::middleware(['auth'])->group(function () {

    // 1. Acciones para TODOS los usuarios (Admin y Normal)
    // Pueden ver la lista y el detalle de un producto
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');

    //Rutas de administrador 
    Route::middleware(['checkRol:admin'])->group(function () {
        // Formulario de creación y guardado
        Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
        Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');

        // Formulario de edición y actualización
        Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
        Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');

        // Eliminación de productos
        Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    });

});