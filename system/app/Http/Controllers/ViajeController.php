<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Viaje;
use Illuminate\Http\Request;

class ViajeController extends Controller
{
    public function index(Request $request)
    {
        $query = Viaje::query()->with(['conductor', 'vehiculo']);

        // Búsqueda
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('cliente_nombre', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('origen', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('destino', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('conductor', function($q) use ($searchTerm) {
                      $q->where('nombre', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('apellido', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        // Filtros
        if ($request->has('estado') && $request->estado) {
            $query->where('estado', $request->estado);
        }

        if ($request->has('metodo_pago') && $request->metodo_pago) {
            $query->where('metodo_pago', $request->metodo_pago);
        }

        if ($request->has('fecha_inicio') && $request->fecha_inicio) {
            $query->whereDate('fecha_hora_inicio', '>=', $request->fecha_inicio);
        }

        if ($request->has('fecha_fin') && $request->fecha_fin) {
            $query->whereDate('fecha_hora_inicio', '<=', $request->fecha_fin);
        }

        // Ordenamiento
        $sortBy = $request->get('sort', 'fecha_hora_inicio');
        $sortOrder = $request->get('order', 'desc');
        
        $allowedSorts = ['fecha_hora_inicio', 'cliente_nombre', 'valor_total', 'estado', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('fecha_hora_inicio', 'desc');
        }

        // Paginación
        $perPage = $request->get('per_page', 10);
        $viajes = $query->paginate($perPage);

        // Para AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'html' => view('viajes.partials.table', compact('viajes'))->render(),
                'pagination' => (string) $viajes->appends($request->except('page'))->links('vendor.pagination.custom'),
                'total' => $viajes->total(),
                'showing' => [
                    'from' => $viajes->firstItem() ?: 0,
                    'to' => $viajes->lastItem() ?: 0,
                    'total' => $viajes->total()
                ]
            ]);
        }

        return view('viajes.index', compact('viajes'));
    }

    public function create()
    {
        return view('viajes.crear');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_nombre' => 'required|string|max:255',
            'cliente_telefono' => 'required|string|max:20',
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'distancia_km' => 'nullable|numeric|min:0',
            'tiempo_estimado_min' => 'nullable|integer|min:0',
            'conductor_id' => 'nullable|exists:conductores,id',
            'vehiculo_id' => 'nullable|exists:vehiculos,id',
            'valor_total' => 'required|numeric|min:0',
            'metodo_pago' => 'required|in:efectivo,qr,transferencia',
            'estado' => 'required|in:pendiente,en_curso,completado,cancelado',
            'observaciones' => 'nullable|string',
        ]);

        $viaje = new Viaje($request->all());
        $viaje->fecha_hora_inicio = now(); // Asumimos inicio al crear, o podría ser un campo del form
        $viaje->save();

        return redirect()->route('viajes.index')->with('success', 'Viaje registrado exitosamente.');
    }

    public function show($id)
    {
        $viaje = Viaje::findOrFail($id);
        return view('viajes.perfil', compact('viaje'));
    }

    public function edit($id)
    {
        $viaje = Viaje::findOrFail($id);
        return view('viajes.editar', compact('viaje'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_nombre' => 'required|string|max:255',
            'cliente_telefono' => 'required|string|max:20',
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'distancia_km' => 'nullable|numeric|min:0',
            'tiempo_estimado_min' => 'nullable|integer|min:0',
            'conductor_id' => 'nullable|exists:conductores,id',
            'vehiculo_id' => 'nullable|exists:vehiculos,id',
            'valor_total' => 'required|numeric|min:0',
            'metodo_pago' => 'required|in:efectivo,qr,transferencia',
            'estado' => 'required|in:pendiente,en_curso,completado,cancelado',
            'observaciones' => 'nullable|string',
        ]);

        $viaje = Viaje::findOrFail($id);
        $viaje->update($request->all());

        return redirect()->route('viajes.index')->with('success', 'Viaje actualizado correctamente.');
    }

    public function destroy($id)
    {
        try {
            $viaje = Viaje::findOrFail($id);
            $viaje->delete();

            return redirect()->route('viajes.index')
                ->with('success', 'Viaje eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('viajes.index')->with('error', 'Error al eliminar el viaje.');
        }
    }
}
