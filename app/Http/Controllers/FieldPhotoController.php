<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\FieldPhoto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FieldPhotoController extends Controller
{
    /**
     * Constructor para aplicar middleware
     * Solo usuarios logueados y admin pueden subir o borrar fotos
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Subir fotos a una cancha
     */
    public function store(Request $request, Field $field)
    {
        $request->validate([
            'photos.*' => 'required|image|max:2048', // cada foto máximo 2MB
        ]);

        if (!$request->hasFile('photos')) {
            return back()->withErrors(['error' => 'No se seleccionaron fotos']);
        }

        DB::beginTransaction();
        try {
            foreach ($request->file('photos') as $photo) {

                // Crear nombre único: cancha-timestamp.extension
                $filename = strtolower(str_replace(' ', '_', $field->name))
                    . '_' . time()
                    . '.' . $photo->getClientOriginalExtension();

                // Guardar la foto en storage/app/public/fields
                $path = $photo->storeAs('fields', $filename, 'public');

                FieldPhoto::create([
                    'field_id' => $field->id,
                    'photo_path' => $path,
                ]);
            }

            DB::commit();
            return back()->with('success', 'Fotos subidas correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'No se pudieron subir las fotos: ' . $e->getMessage()]);
        }
    }

    /**
     * Eliminar una foto de cancha
     */
    public function destroy(FieldPhoto $photo)
    {
        DB::beginTransaction();
        try {
            // Borrar archivo físico
            Storage::disk('public')->delete($photo->photo_path);

            // Borrar registro de base de datos
            $photo->delete();

            DB::commit();
            return back()->with('success', 'Foto eliminada correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'No se pudo eliminar la foto: ' . $e->getMessage()]);
        }
    }
}
