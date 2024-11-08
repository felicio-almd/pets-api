<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
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
            'nome' => 'required|string|max:50',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'especie' => 'required|string',
            'cor' => 'required|string|max:20',
            'sexo' => 'required|string|max:20',
            'raca' => 'nullable|string|max:30',
            'peso' => 'required|integer',
            'data_de_aniversario' => 'nullable|date',
            'vacinas' => 'nullable|string',
            'observacoes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo NOME é obrigatório',
            'nome.max' => 'O NOME não pode ter mais que 50 caracteres',
            'foto.required' => 'A FOTO é obrigatória',
            'foto.image' => 'O arquivo deve ser uma imagem',
            'foto.mimes' => 'A FOTO deve ser do tipo: jpeg, png, jpg',
            'foto.max' => 'A FOTO não pode ser maior que 2MB',
            'especie.required' => 'A ESPÉCIE é obrigatória',
            'cor.required' => 'A COR é obrigatória',
            'cor.max' => 'A COR não pode ter mais que 20 caracteres',
            'sexo.required' => 'O SEXO é obrigatório',
            'sexo.max' => 'O SEXO não pode ter mais que 20 caracteres',
            'raca.max' => 'A RAÇA não pode ter mais que 30 caracteres',
            'peso.required' => 'O PESO é obrigatório',
            'peso.integer' => 'O PESO deve ser um número inteiro',
            'data_de_aniversario.date' => 'A DATA DE ANIVERSÁRIO deve ser uma data válida',
        ];
    }
}
