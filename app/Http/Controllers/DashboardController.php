<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Field;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Constructor: solo admins autenticados pueden acceder
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Mostrar el dashboard con estadísticas
     */
    public function index()
    {
        try {
            // Total de reservas
            $totalReservations = Reservation::count();

            // Total de canchas
            $totalFields = Field::count();

            // Reservas por cancha (puede servir para gráficos)
            $reservationsByField = Reservation::select('field_id', DB::raw('count(*) as total'))
                ->groupBy('field_id')
                ->with('field')
                ->get();

            // Últimas reservas
            $latestReservations = Reservation::with('user', 'field')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            return view('dashboard.index', compact(
                'totalReservations',
                'totalFields',
                'reservationsByField',
                'latestReservations'
            ));

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'No se pudieron cargar las estadísticas: ' . $e->getMessage()]);
        }
    }
}
