<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\FieldPhotoController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
|
| Estas rutas son accesibles sin autenticación.
|
*/

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
|
| Vista del dashboard protegida por autenticación y verificación de email.
|
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas de perfil de usuario
|--------------------------------------------------------------------------
|
| Estas rutas permiten a un usuario autenticado editar, actualizar o
| eliminar su perfil.
|
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Rutas de reservas de canchas (usuarios normales)
|--------------------------------------------------------------------------
|
| Solo usuarios autenticados pueden ver historial, ver detalles y crear reservas.
|
*/
Route::middleware(['auth'])->group(function () {
    Route::resource('reservations', ReservationController::class)
        ->only(['index', 'show', 'create', 'store']);
});

/*
|--------------------------------------------------------------------------
| Rutas de administración (canchas, fotos, dashboard)
|--------------------------------------------------------------------------
|
| Solo usuarios con rol 'admin' pueden acceder.
|
*/
Route::middleware(['auth', 'admin'])->group(function () {

    // CRUD de canchas
    Route::resource('fields', FieldController::class);

    // Dashboard de estadísticas
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Subir fotos a una cancha
    Route::post('fields/{field}/photos', [FieldPhotoController::class, 'store'])
        ->name('fields.photos.store');

    // Eliminar foto individual
    Route::delete('photos/{photo}', [FieldPhotoController::class, 'destroy'])
        ->name('fields.photos.destroy');
});

/*
|--------------------------------------------------------------------------
| Rutas de autenticación
|--------------------------------------------------------------------------
|
| Incluye login, registro, recuperación de contraseña, etc.
|
*/
require __DIR__ . '/auth.php';
