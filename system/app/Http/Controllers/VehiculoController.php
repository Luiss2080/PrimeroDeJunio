<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class VehiculoController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\Vehiculo::query();

        // Búsqueda
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('placa', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('marca', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('modelo', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('propietario_nombre', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filtros
        if ($request->has('estado') && $request->estado) {
            $query->where('estado', $request->estado);
        }

        if ($request->has('marca') && $request->marca) {
            $query->where('marca', $request->marca);
        }

        if ($request->has('ano') && $request->ano) {
            $query->where('ano', $request->ano);
        }

        // Ordenamiento
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        
        $allowedSorts = ['placa', 'marca', 'modelo', 'ano', 'estado', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Paginación
        $perPage = $request->get('per_page', 10);
        $vehiculos = $query->paginate($perPage);

        // Para AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'html' => view('vehiculos.partials.table', compact('vehiculos'))->render(),
                'pagination' => (string) $vehiculos->appends($request->except('page'))->links('vendor.pagination.custom'),
                'total' => $vehiculos->total(),
                'showing' => [
                    'from' => $vehiculos->firstItem() ?: 0,
                    'to' => $vehiculos->lastItem() ?: 0,
                    'total' => $vehiculos->total()
                ]
            ]);
        }

        // Obtener marcas y años para filtros
        $marcas = \App\Models\Vehiculo::select('marca')->distinct()->orderBy('marca')->pluck('marca');
        $anos = \App\Models\Vehiculo::select('ano')->distinct()->orderBy('ano', 'desc')->pluck('ano');

        return view('vehiculos.index', compact('vehiculos', 'marcas', 'anos'));
    }
    public function create()
    {
        return view('vehiculos.crear');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'placa' => 'required|unique:vehiculos|max:10',
            'marca' => 'required',
            'modelo' => 'required',
            'ano' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required',
            'estado' => 'required|in:activo,inactivo,mantenimiento',
            'propietario_nombre' => 'required',
            'propietario_cedula' => 'nullable',
            'propietario_telefono' => 'required',
            'tipo_combustible' => 'nullable',
            'capacidad_pasajeros' => 'nullable|integer',
            'observaciones' => 'nullable',
        ]);

        \App\Models\Vehiculo::create($request->all());

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo creado exitosamente.');
    }

    public function show($id)
    {
        $vehiculo = \App\Models\Vehiculo::findOrFail($id);
        
        // Estadísticas
        $estadisticasActuales = $vehiculo->estadisticasDelMes();
        $estadisticasAnteriores = $vehiculo->estadisticasDelMesAnterior();

        $cambioViajes = $vehiculo->calcularCambio($estadisticasActuales['viajes_completados'], $estadisticasAnteriores['viajes_completados']);
        $cambioIngresos = $vehiculo->calcularCambio($estadisticasActuales['ingresos_generados'], $estadisticasAnteriores['ingresos_generados']);
        $cambioCalificacion = $vehiculo->calcularCambio($estadisticasActuales['calificacion_promedio'], $estadisticasAnteriores['calificacion_promedio']);

        return view('vehiculos.perfil', compact(
            'vehiculo', 
            'estadisticasActuales', 
            'cambioViajes', 
            'cambioIngresos', 
            'cambioCalificacion'
        ));
    }

    public function edit($id)
    {
        $vehiculo = \App\Models\Vehiculo::findOrFail($id);
        return view('vehiculos.editar', compact('vehiculo'));
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $vehiculo = \App\Models\Vehiculo::findOrFail($id);
        
        $validated = $request->validate([
            'placa' => 'required|max:10|unique:vehiculos,placa,' . $id,
            'marca' => 'required',
            'modelo' => 'required',
            'ano' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required',
            'estado' => 'required|in:activo,inactivo,mantenimiento',
            'propietario_nombre' => 'required',
            'propietario_cedula' => 'nullable',
            'propietario_telefono' => 'required',
            'tipo_combustible' => 'nullable',
            'capacidad_pasajeros' => 'nullable|integer',
            'observaciones' => 'nullable',
        ]);

        $vehiculo->update($request->all());

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo actualizado exitosamente.');
    }

    public function destroy($id)
    {
        try {
            $vehiculo = \App\Models\Vehiculo::findOrFail($id);
            $vehiculo->delete();

            return redirect()->route('vehiculos.index')
                ->with('success', 'Vehículo eliminado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->route('vehiculos.index')->with('warning_modal', [
                    'title' => 'No se puede eliminar el vehículo',
                    'message' => 'Este vehículo no se puede eliminar porque tiene registros asociados (conductores, viajes, etc.).'
                ]);
            }
            return redirect()->route('vehiculos.index')->with('error', 'Error al eliminar el vehículo.');
        }
    }
}
