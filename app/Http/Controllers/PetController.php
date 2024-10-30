<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response; // Importar para ter as response corretas
use Throwable;

class PetController extends Controller
{
    private $pets;

    public function __construct(Pet $pet)
    {
        $this->pets = $pet;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // acessar um metodo de um objeto ao inves de um metodo estatico
        $pets = $this->pets->all();

        return response()->json($pets, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
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
        ], [
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
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto', 'public');
            $data['foto'] = url('storage/'.$path);
        }

        $pet = $this->pets->create($data);

        return response()->json([$pet, 'message' => 'Pet criado com sucesso'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $pet = $this->pets->findOrFail($id);

        return response()->json($pet, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */

     // consertar validacoes
    public function update(Request $request, string $id): JsonResponse
    {
        $pet = $this->pets->findOrFail($id);

        $data = $request->validate([
            'nome' => 'sometimes|string|max:50',
            'foto' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'especie' => 'sometimes|string',
            'cor' => 'sometimes|string|max:20',
            'sexo' => 'sometimes|string|max:20',
            'raca' => 'string|max:30',
            'peso' => 'sometimes|integer',
            'data_de_aniversario' => 'date',
            'vacinas' => 'string',
            'observacoes' => 'string',
        ], [
            'nome.sometimes' => 'O campo NOME é obrigatório',
            'nome.max' => 'O NOME não pode ter mais que 50 caracteres',
            'foto.sometimes' => 'A FOTO é obrigatória',
            'foto.image' => 'O arquivo deve ser uma imagem',
            'foto.mimes' => 'A FOTO deve ser do tipo: jpeg, png, jpg',
            'foto.max' => 'A FOTO não pode ser maior que 2MB',
            'especie.sometimes' => 'A ESPÉCIE é obrigatória',
            'cor.sometimes' => 'A COR é obrigatória',
            'cor.max' => 'A COR não pode ter mais que 20 caracteres',
            'sexo.sometimes' => 'O SEXO é obrigatório',
            'sexo.max' => 'O SEXO não pode ter mais que 20 caracteres',
            'raca.max' => 'A RAÇA não pode ter mais que 30 caracteres',
            'peso.sometimes' => 'O PESO é obrigatório',
            'peso.integer' => 'O PESO deve ser um número inteiro',
            'data_de_aniversario.date' => 'A DATA DE ANIVERSÁRIO deve ser uma data válida',
        ]);

        if ($request->hasFile('foto')) {
            try {
                if ($pet['foto']) {
                    $image_name = explode('foto/', $pet['foto']);
                    Storage::disk('public')->delete('foto/'.$image_name[1]);
                }
            } catch (Throwable) {
            } finally {
                $path = $request->file('foto')->store('foto', 'public');
                $data['foto'] = url('storage/'.$path);
            }

        }
        $pet->update($data);

        return response()->json([$pet, 'message' => 'Pet atualizado com sucesso'], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pet = $this->pets->find($id);
        $pet->delete();

        return response()->json(['message' => 'Pet deletado com sucesso!']);
    }
}
