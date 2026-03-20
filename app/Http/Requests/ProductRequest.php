<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100|unique:productos,nombre',
            'precio' => 'required|numeric|min:0.01',
            'descripcion' => 'nullable|string|max:500',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.string' => 'El nombre del producto debe ser una cadena de texto.',
            'nombre.max' => 'El nombre del producto no puede exceder los 100 caracteres.',
            'nombre.unique' => 'El nombre del producto ya existe. Por favor, elige otro nombre.',
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio del producto debe ser un número.',
            'precio.min' => 'El precio del producto debe ser al menos 0.01.',
            'descripcion.string' => 'La descripción del producto debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción del producto no puede exceder los 500 caracteres.',
            'stock.required' => 'El stock del producto es obligatorio.',
            'stock.integer' => 'El stock del producto debe ser un número entero.',
            'stock.min' => 'El stock del producto no puede ser negativo.',
        ];
    }
}
