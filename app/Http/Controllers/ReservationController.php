<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    /**
     * Mostrar historial de reservas del usuario
     */
    public function index()
    {
        $reservations = Auth::user()->reservations()->with('field')->get();
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Formulario para nueva reserva
     */
    public function create()
    {
        $fields = Field::all(); // mostrar todas las canchas
        return view('reservations.create', compact('fields'));
    }

    /**
     * Guardar nueva reserva usando transacción
     */
    public function store(Request $request)
    {
        $request->validate([
            'field_id' => 'required|exists:fields,id',
            'date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $reservation = Reservation::create([
                'user_id' => Auth::id(),
                'field_id' => $request->field_id,
                'date' => $request->date,
                'time_slot' => $request->time_slot,
            ]);

            // Aquí podrías agregar más lógica: enviar correo, logs, etc.

            DB::commit();
            return redirect()->route('reservations.index')
                ->with('success', 'Reserva creada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'No se pudo crear la reserva: ' . $e->getMessage()]);
        }
    }

    /**
     * Mostrar detalle de reserva
     */
    public function show(Reservation $reservation)
    {
        $this->authorize('view', $reservation); // si usás policies
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Cancelar reserva
     */
    public function destroy(Reservation $reservation)
    {
        $this->authorize('delete', $reservation); // si usás policies

        DB::beginTransaction();
        try {
            $reservation->delete();
            DB::commit();

            return redirect()->route('reservations.index')
                ->with('success', 'Reserva cancelada correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'No se pudo cancelar la reserva: ' . $e->getMessage()]);
        }
    }
}
