<?php

namespace App\Http\Controllers;

use App\Models\Chaleco;
use App\Models\Conductor;
use Illuminate\Http\Request;

class ChalecoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Chaleco::with('conductorActual');

        // Filtros
        if ($request->has('estado') && $request->estado) {
            $query->where('estado', $request->estado);
        }

        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('cod_chaleco', 'like', "%{$request->search}%")
                  ->orWhere('descripcion', 'like', "%{$request->search}%");
            });
        }

        $chalecos = $query->orderBy('cod_chaleco', 'asc')->paginate(15);

        return view('chalecos.index', compact('chalecos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proximoCodigo = Chaleco::generarProximoCodigo();
        return view('chalecos.crear', compact('proximoCodigo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cod_chaleco' => 'required|string|max:10|unique:chalecos,cod_chaleco',
            'descripcion' => 'nullable|string|max:500',
            'fecha_adquisicion' => 'nullable|date',
            'costo' => 'nullable|numeric|min:0|max:999999.99'
        ]);

        Chaleco::create($request->all());

        return redirect()->route('chalecos.index')
                        ->with('success', 'Chaleco creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chaleco $chaleco)
    {
        $chaleco->load('conductorActual');
        return view('chalecos.show', compact('chaleco'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chaleco $chaleco)
    {
        return view('chalecos.edit', compact('chaleco'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chaleco $chaleco)
    {
        $request->validate([
            'cod_chaleco' => 'required|string|max:10|unique:chalecos,cod_chaleco,' . $chaleco->id,
            'descripcion' => 'nullable|string|max:500',
            'fecha_adquisicion' => 'nullable|date',
            'costo' => 'nullable|numeric|min:0|max:999999.99',
            'estado' => 'required|in:disponible,asignado,mantenimiento,perdido'
        ]);

        $chaleco->update($request->all());

        return redirect()->route('chalecos.index')
                        ->with('success', 'Chaleco actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chaleco $chaleco)
    {
        // No permitir eliminar chalecos asignados
        if ($chaleco->isAsignado()) {
            return redirect()->back()
                           ->with('error', 'No se puede eliminar un chaleco que está asignado a un conductor.');
        }

        $chaleco->delete();

        return redirect()->route('chalecos.index')
                        ->with('success', 'Chaleco eliminado exitosamente.');
    }

    /**
     * Asignar chaleco a conductor
     */
    public function asignar(Request $request)
    {
        $request->validate([
            'chaleco_id' => 'required|exists:chalecos,id',
            'conductor_id' => 'required|exists:conductores,id'
        ]);

        $chaleco = Chaleco::find($request->chaleco_id);
        $conductor = Conductor::find($request->conductor_id);

        if ($chaleco->asignarAConductor($conductor)) {
            return redirect()->back()
                           ->with('success', "Chaleco {$chaleco->cod_chaleco} asignado exitosamente a {$conductor->nombre} {$conductor->apellido}");
        }

        return redirect()->back()
                       ->with('error', 'No se pudo asignar el chaleco. Verifique que esté disponible.');
    }

    /**
     * Liberar chaleco
     */
    public function liberar(Chaleco $chaleco)
    {
        if ($chaleco->liberar()) {
            return redirect()->back()
                           ->with('success', "Chaleco {$chaleco->cod_chaleco} liberado exitosamente.");
        }

        return redirect()->back()
                       ->with('error', 'No se pudo liberar el chaleco.');
    }

    /**
     * Obtener chalecos disponibles para AJAX
     */
    public function disponibles()
    {
        $chalecos = Chaleco::disponibles()
                          ->select('id', 'cod_chaleco', 'descripcion')
                          ->orderBy('cod_chaleco')
                          ->get();

        return response()->json($chalecos);
    }
}
