<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonaRequest extends FormRequest
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
        return [
            'nombre' => 'required|max:100|unique:personas,nombre',
            'dni' => 'required|max:8|min:8|unique:personas,dni',
            'sistema_pension' => 'nullable|max:5',
            'tipo_sistema_pension' => 'nullable|max:20',
            'cusp' => 'nullable|max:50',
            'fecha_nacimiento' => 'required',
            'fecha_ingreso' => 'required',
            'cargo_id' => 'required',
            'regimene_id' => 'nullable',
            'contrato_id' => 'required'
        ];
    }

    public function attributes(){
        return[
            'nombre' => 'Nombre y Apellido',
            'dni' => 'DNI',
            'sistema_pension' => 'Sistema fondo Pensión',
            'tipo_sistema_pension' => 'Tipo Sistema fondo Pensión',
            'cusp' => 'CUSPP',
            'fecha_nacimiento' => 'Fecha de Nacimiento',
            'fecha_ingreso' => 'Fecha de Ingreso'
        ];
    }

    public function messages(){
        return[
            'nombre.required' => 'Debe ingresar el Nombre Completo del Trabajdor',
            'cargo_id.required' => 'Debe seleccionar un Cargo',
            'contrato_id.required' => 'Debe seleccionar un Contrato'
        ];
    }
}