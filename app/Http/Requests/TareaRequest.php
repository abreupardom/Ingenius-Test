<?php

namespace App\Http\Requests;

use App\Models\Tarea;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TareaRequest extends FormRequest
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
            'nombre' => ['required', 'string','max:255', $this->validacioUnico()],
            'estado' => 'required|string',
            'prioridad' => 'required|string',
            'proyecto_id' => 'required|integer',
        ];

    }

    /**
     * Mensajes personalizados
     * @return string[]
     */
    public function messages(): array
    {
        //mensajes personalizados de la validaciones
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.max' => 'El nombre no debe ser mayor a 255 caracteres',
            'nombre.unique' => 'El nombre ya existe',
            'estado.required' => 'El estado es requerido',
            'prioridad.required' => 'El prioridad es requerida',
            'proyecto_id.required' => 'El proyecto es requerido',
            'nombre.string' => 'El nombre debe ser un texto',
            'estado.string' => 'El estado debe ser un texto',
            'prioridad.string' => 'El prioridad debe ser un texto',
            'proyecto_id.integer' => 'El proyecto debe ser un número',
        ];
    }

    /**
     * @return \Illuminate\Validation\Rules\Unique
     */
    private function validacioUnico()
    {
       return Rule::unique('tareas')->where(function ($query) {
            //chequear que exista un proyecto con el mismo usuario y mismo id de proyecto que tenga el nombre de la tarea
            return $query->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('proyectos')
                    ->whereRaw('proyectos.id = tareas.proyecto_id')
                    ->where('usuario_id', Auth::user()->id)
                    ->where('id', $this->input('proyecto_id'));
            });
        })->ignore($this->route('tarea'));//ignoro si es el mismo id de la tarea o sea cuando estoy editando
    }
}
