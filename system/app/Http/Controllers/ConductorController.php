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
        $conductor = Conductor::with('asignaciones.vehiculo')->findOrFail($id);
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
}
