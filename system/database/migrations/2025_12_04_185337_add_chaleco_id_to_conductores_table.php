<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('conductores', function (Blueprint $table) {
            $table->foreignId('chaleco_id')->nullable()->after('id')->constrained('chalecos')->onDelete('set null');
            $table->datetime('fecha_asignacion_chaleco')->nullable()->after('chaleco_id')->comment('Fecha y hora de asignación del chaleco');
            
            // Índices
            $table->index('chaleco_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conductores', function (Blueprint $table) {
            $table->dropForeign(['chaleco_id']);
            $table->dropColumn(['chaleco_id', 'fecha_asignacion_chaleco']);
        });
    }
};
