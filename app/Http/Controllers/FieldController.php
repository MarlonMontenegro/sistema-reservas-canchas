<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\FieldPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FieldController extends Controller
{
    /**
     * Mostrar todas las canchas
     */
    public function index()
    {
        $fields = Field::with('photos')->get();
        return view('fields.index', compact('fields'));
    }

    /**
     * Formulario para crear nueva cancha
     */
    public function create()
    {
        return view('fields.create');
    }

    /**
     * Guardar nueva cancha con transacción
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            $field = Field::create([
                'name' => $request->name,
                'type' => $request->type,
            ]);

            // Subir fotos si vienen
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('fields', 'public');
                    FieldPhoto::create([
                        'field_id' => $field->id,
                        'photo_path' => $path,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('fields.index')->with('success', 'Cancha creada correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'No se pudo crear la cancha: ' . $e->getMessage()]);
        }
    }

    /**
     * Mostrar cancha individual
     */
    public function show(Field $field)
    {
        $field->load('photos');
        return view('fields.show', compact('field'));
    }

    /**
     * Formulario para editar cancha
     */
    public function edit(Field $field)
    {
        return view('fields.edit', compact('field'));
    }

    /**
     * Actualizar cancha
     */
    public function update(Request $request, Field $field)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            $field->update([
                'name' => $request->name,
                'type' => $request->type,
            ]);

            // Subir fotos nuevas si hay
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('fields', 'public');
                    FieldPhoto::create([
                        'field_id' => $field->id,
                        'photo_path' => $path,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('fields.index')->with('success', 'Cancha actualizada correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'No se pudo actualizar la cancha: ' . $e->getMessage()]);
        }
    }

    /**
     * Eliminar cancha
     */
    public function destroy(Field $field)
    {
        DB::beginTransaction();
        try {
            // Opcional: borrar fotos asociadas
            foreach ($field->photos as $photo) {
                \Storage::disk('public')->delete($photo->photo_path);
                $photo->delete();
            }

            $field->delete();
            DB::commit();
            return redirect()->route('fields.index')->with('success', 'Cancha eliminada correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'No se pudo eliminar la cancha: ' . $e->getMessage()]);
        }
    }
}
