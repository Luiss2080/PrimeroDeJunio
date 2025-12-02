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
            $table->string('email', 100)->nullable()->after('telefono');
            $table->decimal('rating', 3, 1)->default(5.0)->after('estado');
            $table->integer('total_viajes')->default(0)->after('rating');
            $table->integer('asistencia_porcentaje')->default(100)->after('total_viajes');
            $table->date('antecedentes_verificados_at')->nullable()->after('observaciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conductores', function (Blueprint $table) {
            $table->dropColumn([
                'email',
                'rating',
                'total_viajes',
                'asistencia_porcentaje',
                'antecedentes_verificados_at'
            ]);
        });
    }
};
