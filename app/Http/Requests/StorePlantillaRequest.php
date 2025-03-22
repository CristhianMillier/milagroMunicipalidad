<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlantillaRequest extends FormRequest
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
            'mes' => 'required|max:20',
            'anio' => 'required|max:4|min:4',
            'tipo_plantilla_id' => 'required',
            'persona_id' => 'required',
            'dias_labor' => 'required|max:2',
            'user_id' => 'required|exists:users,id',
            'total_haberes' => 'required',
            'total_descuentos' => 'required',
            'total_aportes' => 'required',
            'fecha_hora' => 'required',
            'importe_pago' => 'required'
        ];
    }

    public function attributes(){
        return[
            'mes' => 'Mes',
            'anio' => 'Año',
            'tipo_plantilla_id' => 'Tipo de Plantilla',
            'persona_id' => 'Trabajador',
            'user_id' => 'Usuario',
            'importe_pago' => 'Importe Pagado'
        ];
    }
}