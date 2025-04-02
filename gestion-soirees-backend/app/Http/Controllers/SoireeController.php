<?php

namespace App\Http\Controllers;

use App\Models\Soiree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SoireeController extends Controller
{
    public function index()
    {
        $soirees = Soiree::with(['reservations', 'goodies'])->get();
        return response()->json($soirees);
    }

    public function store(Request $request)
    {
        // Convertir les noms de champs du frontend vers le backend
        $data = $request->all();
        $data['capacite_maximale'] = $data['capaciteMaximale'] ?? null;
        unset($data['capaciteMaximale']);

        $validator = Validator::make($data, [
            'nom' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'date' => 'required|date',
            'prix' => 'required|numeric|min:0',
            'capacite_maximale' => 'required|integer|min:1',
            'theme' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $soiree = Soiree::create($data);
        return response()->json($soiree, 201);
    }

    public function show(Soiree $soiree)
    {
        return response()->json($soiree->load(['reservations', 'goodies']));
    }

    public function update(Request $request, Soiree $soiree)
    {
        // Convertir les noms de champs du frontend vers le backend
        $data = $request->all();
        if (isset($data['capaciteMaximale'])) {
            $data['capacite_maximale'] = $data['capaciteMaximale'];
            unset($data['capaciteMaximale']);
        }

        $validator = Validator::make($data, [
            'nom' => 'sometimes|required|string|max:255',
            'lieu' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|date',
            'prix' => 'sometimes|required|numeric|min:0',
            'capacite_maximale' => 'sometimes|required|integer|min:1',
            'theme' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $soiree->update($data);
        return response()->json($soiree);
    }

    public function destroy(Soiree $soiree)
    {
        $soiree->delete();
        return response()->json(null, 204);
    }
} 