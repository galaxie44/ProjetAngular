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
        $reservations = Reservation::with('soiree')->get();
        return response()->json($reservations);
    }

    public function show($id)
    {
        $reservation = Reservation::with('soiree')->find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Réservation non trouvée'], 404);
        }
        return response()->json($reservation);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_etudiant' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'soiree_id' => 'required|exists:soirees,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $soiree = Soiree::find($request->soiree_id);
        if ($soiree->places_disponibles <= 0) {
            return response()->json(['message' => 'Plus de places disponibles pour cette soirée'], 400);
        }

        $reservation = Reservation::create([
            'nom_etudiant' => $request->nom_etudiant,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'soiree_id' => $request->soiree_id,
            'date_reservation' => now(),
            'statut' => 0 // En attente
        ]);

        // Mettre à jour le nombre de places disponibles
        $soiree->places_disponibles--;
        $soiree->save();

        return response()->json($reservation, 201);
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Réservation non trouvée'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nom_etudiant' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $reservation->update($request->all());
        return response()->json($reservation);
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Réservation non trouvée'], 404);
        }

        // Restaurer une place disponible si la réservation n'est pas annulée
        if ($reservation->statut != 2) {
            $soiree = $reservation->soiree;
            $soiree->places_disponibles++;
            $soiree->save();
        }

        $reservation->delete();
        return response()->json(null, 204);
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Réservation non trouvée'], 404);
        }

        $validator = Validator::make($request->all(), [
            'statut' => 'required|integer|in:0,1,2', // 0: en attente, 1: confirmée, 2: annulée
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $oldStatus = $reservation->statut;
        $reservation->statut = $request->statut;
        $reservation->save();

        // Gérer les places disponibles en fonction du changement de statut
        if ($oldStatus != 2 && $request->statut == 2) {
            // Si la réservation est annulée, restaurer une place
            $soiree = $reservation->soiree;
            $soiree->places_disponibles++;
            $soiree->save();
        } elseif ($oldStatus == 2 && $request->statut != 2) {
            // Si une réservation annulée est réactivée, retirer une place
            $soiree = $reservation->soiree;
            if ($soiree->places_disponibles > 0) {
                $soiree->places_disponibles--;
                $soiree->save();
            } else {
                return response()->json(['message' => 'Plus de places disponibles pour cette soirée'], 400);
            }
        }

        return response()->json($reservation);
    }
} 