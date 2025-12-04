<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    public function index()
    {
        $conductores = Conductor::with('asignaciones.vehiculo')->get();
        return view('conductores.index', compact('conductores'));
    }

    public function show($id)
    {
        $conductor = Conductor::with(['asignaciones.vehiculo', 'viajes' => function($query) {
            $query->latest('fecha_hora_inicio')->take(10);
        }])->findOrFail($id);
        return view('conductores.perfil', compact('conductor'));
    }
    
    public function create()
    {
        return view('conductores.crear');
    }

    public function edit($id)
    {
        $conductor = Conductor::findOrFail($id);
        return view('conductores.editar', compact('conductor'));
    }
    public function destroy($id)
    {
        try {
            $conductor = Conductor::findOrFail($id);
            $conductor->delete();
            return redirect()->route('conductores.index')->with('success', 'Conductor eliminado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect()->route('conductores.index')->with('warning_modal', [
                    'title' => 'No se puede eliminar',
                    'message' => 'Este conductor no se puede eliminar porque tiene registros asociados (viajes, turnos, etc). Debes eliminar esos registros primero.'
                ]);
            }
            return redirect()->route('conductores.index')->with('error', 'Ocurrió un error al intentar eliminar el conductor.');
        } catch (\Exception $e) {
            return redirect()->route('conductores.index')->with('error', 'Error inesperado: ' . $e->getMessage());
        }
    }
}
