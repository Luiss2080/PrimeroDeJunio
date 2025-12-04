<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Búsqueda
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nombre', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('apellido', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('telefono', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filtros
        if ($request->has('estado') && $request->estado) {
            $query->where('estado', $request->estado);
        }

        if ($request->has('rol') && $request->rol) {
            // Asumiendo que rol_id se relaciona con una tabla de roles o es un enum/string
            // Si es una relación, ajustar acorde. Si es string directo:
             $query->where('rol_id', $request->rol);
        }

        // Ordenamiento
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        
        // Validar columnas permitidas para ordenar para evitar SQL Injection
        $allowedSorts = ['nombre', 'email', 'created_at', 'estado', 'rol_id'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Paginación
        $perPage = $request->get('per_page', 10);
        $usuarios = $query->paginate($perPage);

        // Para AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'html' => view('usuarios.partials.table', compact('usuarios'))->render(),
                'pagination' => (string) $usuarios->appends($request->except('page'))->links(),
                'total' => $usuarios->total(),
                'showing' => [
                    'from' => $usuarios->firstItem() ?: 0,
                    'to' => $usuarios->lastItem() ?: 0,
                    'total' => $usuarios->total()
                ]
            ]);
        }

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        // return view('usuarios.crear');
        return abort(404);
    }

    public function store(Request $request)
    {
        // Implementar validación y creación
        return abort(404);
    }

    public function show(User $user)
    {
        // return view('usuarios.perfil', compact('user'));
        return abort(404);
    }

    public function edit(User $user)
    {
        // return view('usuarios.editar', compact('user'));
        return abort(404);
    }

    public function update(Request $request, User $user)
    {
        // Implementar actualización
        return abort(404);
    }

    public function destroy(User $user)
    {
        // Implementar eliminación
        return abort(404);
    }
}
