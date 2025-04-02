<?php

namespace App\Http\Controllers;

use App\Models\Goodie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoodieController extends Controller
{
    public function index()
    {
        return response()->json(Goodie::with('soiree')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantite_disponible' => 'required|integer|min:0',
            'image_url' => 'nullable|string|max:255',
            'soiree_id' => 'required|exists:soirees,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $goodie = Goodie::create($request->all());
        return response()->json($goodie->load('soiree'), 201);
    }

    public function show(Goodie $goodie)
    {
        return response()->json($goodie->load('soiree'));
    }

    public function update(Request $request, Goodie $goodie)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'quantite_disponible' => 'sometimes|required|integer|min:0',
            'image_url' => 'nullable|string|max:255',
            'soiree_id' => 'sometimes|required|exists:soirees,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $goodie->update($request->all());
        return response()->json($goodie->load('soiree'));
    }

    public function destroy(Goodie $goodie)
    {
        $goodie->delete();
        return response()->json(null, 204);
    }

    public function updateQuantite(Request $request, Goodie $goodie)
    {
        $validator = Validator::make($request->all(), [
            'quantite' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $nouvelleQuantite = $goodie->quantite_disponible + $request->quantite;
        
        if ($nouvelleQuantite < 0) {
            return response()->json([
                'message' => 'La quantité disponible ne peut pas être négative'
            ], 400);
        }

        $goodie->quantite_disponible = $nouvelleQuantite;
        $goodie->save();

        return response()->json($goodie);
    }
} 