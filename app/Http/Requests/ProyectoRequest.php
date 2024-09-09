<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProyectoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //validaciones del modelo
        return [
            'nombre' => ['required', 'string', 'max:255', $this->validacioUnico()],
            'descripcion' => 'nullable|string|max:255',
            'archivado' => 'nullable|boolean',
            'usuario_id' => 'integer|exists:users,id',
        ];
    }

    public function messages(): array
    {
        //mensajes personalizados de las validaciones
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.string' => 'El nombre debe ser un texto',
            'nombre.max' => 'El nombre no debe ser mayor a 255 caracteres',
            'nombre.unique' => 'El nombre ya existe',
            'descripcion.string' => 'La descripción debe ser un texto',
            'descripcion.max' => 'La descripción no debe ser mayor a 255 caracteres',
            'archivado.boolean' => 'El archivado debe ser boolean',
            'usuario_id.integer' => 'El usuario debe ser un número',
            'usuario_id.exists' => 'El usuario no existe',
        ];
    }

    /**
     * Valida que sea único
     * @return \Illuminate\Validation\Rules\Unique
     */
    private function validacioUnico()
    {
        return Rule::unique('proyectos')->where(function ($query) {
            //chequear que para ese usuario ya existe es  nombre de proyecto
            $query->where('usuario_id', Auth::user()->id);
        })->ignore($this->route('proyecto'));//ignoro si es el mismo id del proyecto o sea cuando estoy editando
    }
}
