<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    public function index(Request $request)
    {
        $query = Conductor::with(['asignaciones.vehiculo', 'viajes', 'chaleco']);

        // Búsqueda
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nombre', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('apellido', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('cedula', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('telefono', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filtros
        if ($request->has('estado') && $request->estado) {
            $query->where('estado', $request->estado);
        }

        if ($request->has('estado_pago') && $request->estado_pago) {
            $query->where('estado_pago', $request->estado_pago);
        }

        if ($request->has('vehiculo') && $request->vehiculo) {
            if ($request->vehiculo === 'asignado') {
                $query->whereHas('asignaciones', function($q) {
                    $q->where('estado', 'activa');
                });
            } elseif ($request->vehiculo === 'sin_asignar') {
                $query->whereDoesntHave('asignaciones', function($q) {
                    $q->where('estado', 'activa');
                });
            }
        }

        if ($request->has('fecha_desde') && $request->fecha_desde) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }

        if ($request->has('fecha_hasta') && $request->fecha_hasta) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }

        if ($request->has('rating_min') && $request->rating_min) {
            $query->where('rating', '>=', $request->rating_min);
        }

        // Ordenamiento
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginación
        $perPage = $request->get('per_page', 10);
        $conductores = $query->paginate($perPage);

        // Para AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'html' => view('conductores.partials.table', compact('conductores'))->render(),
                'pagination' => (string) $conductores->appends($request->except('page'))->links(),
                'total' => $conductores->total(),
                'showing' => [
                    'from' => $conductores->firstItem() ?: 0,
                    'to' => $conductores->lastItem() ?: 0,
                    'total' => $conductores->total()
                ]
            ]);
        }

        return view('conductores.index', compact('conductores'));
    }

    public function show($id)
    {
        $conductor = Conductor::with([
            'asignaciones.vehiculo', 
            'viajes' => function($query) {
                $query->latest('fecha_hora_inicio')->take(10);
            },
            'documentos',
            'chaleco'
        ])->findOrFail($id);

        // Obtener estadísticas del conductor
        $estadisticasActuales = $conductor->estadisticasDelMes();
        $estadisticasAnteriores = $conductor->estadisticasDelMesAnterior();

        // Calcular cambios porcentuales
        $cambioViajes = $conductor->calcularCambio(
            $estadisticasActuales['viajes_completados'], 
            $estadisticasAnteriores['viajes_completados']
        );
        
        $cambioIngresos = $conductor->calcularCambio(
            $estadisticasActuales['ingresos_generados'], 
            $estadisticasAnteriores['ingresos_generados']
        );

        $cambioCalificacion = $conductor->calcularCambio(
            $estadisticasActuales['calificacion_promedio'], 
            $estadisticasAnteriores['calificacion_promedio']
        );

        return view('conductores.perfil', compact(
            'conductor', 
            'estadisticasActuales', 
            'estadisticasAnteriores',
            'cambioViajes',
            'cambioIngresos', 
            'cambioCalificacion'
        ));
    }
    
    public function create()
    {
        return view('conductores.crear');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'cedula' => 'required|string|max:20|unique:conductores,cedula',
            'telefono' => 'required|string|max:50',
            'email' => 'nullable|email|max:100',
            'direccion' => 'nullable|string',
            'fecha_nacimiento' => 'required|date',
            'grupo_sanguineo' => 'nullable|string|max:5',
            'contacto_emergencia_nombre' => 'nullable|string|max:100',
            'contacto_emergencia_telefono' => 'nullable|string|max:20',
            'experiencia_anos' => 'nullable|integer|min:0',
            'estado' => 'required|in:activo,inactivo,suspendido',
            'observaciones' => 'nullable|string'
        ]);

        // Establecer valores por defecto
        $validatedData['rating'] = 5.0;
        $validatedData['total_viajes'] = 0;
        $validatedData['asistencia_porcentaje'] = 100;
        $validatedData['antecedentes_penales'] = false;
        $validatedData['estado_pago'] = 'al_dia';
        $validatedData['fecha_ingreso'] = now()->toDateString();

        $conductor = Conductor::create($validatedData);

        return redirect()->route('conductores.index')->with('success', 'Conductor creado correctamente.');
    }

    public function edit($id)
    {
        $conductor = Conductor::findOrFail($id);
        return view('conductores.editar', compact('conductor'));
    }

    public function update(Request $request, $id)
    {
        $conductor = Conductor::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'cedula' => 'required|string|max:20|unique:conductores,cedula,' . $conductor->id,
            'telefono' => 'required|string|max:50',
            'email' => 'nullable|email|max:100',
            'direccion' => 'nullable|string',
            'fecha_nacimiento' => 'required|date',
            'grupo_sanguineo' => 'nullable|string|max:5',
            'contacto_emergencia_nombre' => 'nullable|string|max:100',
            'contacto_emergencia_telefono' => 'nullable|string|max:20',
            'experiencia_anos' => 'nullable|integer|min:0',
            'estado' => 'required|in:activo,inactivo,suspendido',
            'estado_pago' => 'required|in:al_dia,mora,pendiente',
            'asistencia_porcentaje' => 'nullable|integer|min:0|max:100',
            'observaciones' => 'nullable|string'
        ]);

        $conductor->update($validatedData);

        return redirect()->route('conductores.show', $conductor->id)->with('success', 'Conductor actualizado correctamente.');
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
