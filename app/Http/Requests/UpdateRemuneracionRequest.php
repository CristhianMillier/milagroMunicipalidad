<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRemuneracionRequest extends FormRequest
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
        $remuneracion = $this->route('remuneracione');
        $remuneracionID = $remuneracion->id;
        return [
            'nombre' => 'required|max:50|unique:regimenes,tipo_regimene,'.$remuneracionID
        ];
    }
}