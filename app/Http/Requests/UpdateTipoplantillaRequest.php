<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTipoplantillaRequest extends FormRequest
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
        $tipo = $this->route('tipoplantilla');
        $tipoID = $tipo->id;
        return [
            'nombre' => 'required|max:250|unique:tipo_plantillas,nombre,'.$tipoID
        ];
    }
}