<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MantenimientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mantenimientos = [];
        
        // Generar mantenimientos para diferentes vehículos
        for ($i = 1; $i <= 30; $i++) {
            $fechaMantenimiento = now()->subDays(rand(0, 180));
            $costo = rand(50000, 500000);
            
            $mantenimientos[] = [
                'vehiculo_id' => rand(1, 13),
                'tipo_mantenimiento' => $this->getTipoMantenimientoAleatorio(),
                'descripcion' => $this->getDescripcionAleatoria(),
                'fecha_mantenimiento' => $fechaMantenimiento->toDateString(),
                'kilometraje' => rand(15000, 150000),
                'costo' => $costo,
                'taller' => $this->getTallerAleatorio(),
                'observaciones' => $this->getObservacionAleatoria(),
                'estado' => $this->getEstadoAleatorio(),
                'created_at' => $fechaMantenimiento,
                'updated_at' => $fechaMantenimiento
            ];
        }
        
        DB::table('mantenimientos')->insert($mantenimientos);
    }
    
    private function getTipoMantenimientoAleatorio()
    {
        $tipos = [
            'preventivo',
            'correctivo',
            'emergencia',
            'revision_tecnica',
            'cambio_aceite',
            'reparacion_motor'
        ];
        
        return $tipos[array_rand($tipos)];
    }
    
    private function getDescripcionAleatoria()
    {
        $descripciones = [
            'Cambio de aceite y filtros',
            'Reparación de frenos',
            'Revisión general del motor',
            'Cambio de llantas',
            'Reparación del sistema eléctrico',
            'Mantenimiento de la suspensión',
            'Cambio de batería',
            'Reparación de la transmisión',
            'Ajuste de carburador',
            'Cambio de bujías',
            'Reparación del escape',
            'Mantenimiento preventivo general'
        ];
        
        return $descripciones[array_rand($descripciones)];
    }
    
    private function getTallerAleatorio()
    {
        $talleres = [
            'Taller Central Motos',
            'Mecánica El Experto',
            'Serviteca Los Hermanos',
            'Taller Rápido Express',
            'Mecánica Profesional',
            'Taller San José',
            'Moto Repuestos y Servicio',
            'Taller La Confianza'
        ];
        
        return $talleres[array_rand($talleres)];
    }
    
    private function getObservacionAleatoria()
    {
        $observaciones = [
            'Mantenimiento completado exitosamente',
            'Se recomienda revisar en 3 meses',
            'Repuestos originales utilizados',
            'Trabajo garantizado por 6 meses',
            'Vehículo en óptimas condiciones',
            'Se cambió aceite sintético',
            'Revisión completa realizada',
            null
        ];
        
        return $observaciones[array_rand($observaciones)];
    }
    
    private function getEstadoAleatorio()
    {
        $estados = ['completado', 'completado', 'completado', 'pendiente', 'en_proceso'];
        return $estados[array_rand($estados)];
    }
}