<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetRequest;
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
    public function store(PetRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $foto = $request->file('foto');
            $nomeFoto = $foto->hashName(); // Gera um nome único para a imagem
            $foto->move(storage_path('app/public/fotos'), $nomeFoto); // Move a imagem para o diretório

            // Cria a URL completa da imagem e armazena na variável $data
            $data['foto'] = asset('storage/fotos/'.$nomeFoto);
        }

        $pet = $this->pets->create($data);

        return response()->json(['message' => 'Pet criado com sucesso', $pet], Response::HTTP_CREATED);
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

        $data = $request->validated();

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

        return response()->json(['message' => 'Pet atualizado com sucesso', $pet], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $pet = $this->pets->find($id);
        $pet->delete();

        return response()->json(['message' => 'Pet deletado com sucesso!']);
    }
}
