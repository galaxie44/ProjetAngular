<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Soiree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function index()
    {
        return response()->json(Reservation::with('soiree')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_etudiant' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'soiree_id' => 'required|exists:soirees,id',
            'date_reservation' => 'required|date',
            'statut' => 'required|in:Confirmee,En attente,Annulee'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Vérifier la capacité de la soirée
        $soiree = Soiree::find($request->soiree_id);
        $reservationsCount = $soiree->reservations()->where('statut', 'Confirmee')->count();

        if ($reservationsCount >= $soiree->capacite_maximale) {
            return response()->json([
                'message' => 'La soirée est complète'
            ], 400);
        }

        $reservation = Reservation::create($request->all());
        return response()->json($reservation->load('soiree'), 201);
    }

    public function show(Reservation $reservation)
    {
        return response()->json($reservation->load('soiree'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validator = Validator::make($request->all(), [
            'nom_etudiant' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255',
            'telephone' => 'sometimes|required|string|max:20',
            'soiree_id' => 'sometimes|required|exists:soirees,id',
            'date_reservation' => 'sometimes|required|date',
            'statut' => 'sometimes|required|in:Confirmee,En attente,Annulee'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Si le statut change pour "Confirmee", vérifier la capacité
        if ($request->has('statut') && 
            $request->statut === 'Confirmee' && 
            $reservation->statut !== 'Confirmee') {
            
            $soiree = Soiree::find($reservation->soiree_id);
            $reservationsCount = $soiree->reservations()->where('statut', 'Confirmee')->count();

            if ($reservationsCount >= $soiree->capacite_maximale) {
                return response()->json([
                    'message' => 'La soirée est complète'
                ], 400);
            }
        }

        $reservation->update($request->all());
        return response()->json($reservation->load('soiree'));
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(null, 204);
    }
} 