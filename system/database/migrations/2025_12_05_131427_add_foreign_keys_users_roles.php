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
        // Agregar foreign key de users a roles
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('rol_id')->references('id')->on('roles')->restrictOnDelete();
        });
        
        // Agregar foreign keys de roles a users
        Schema::table('roles', function (Blueprint $table) {
            $table->foreign('creado_por')->references('id')->on('users')->nullOnDelete();
            $table->foreign('actualizado_por')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['rol_id']);
        });
        
        Schema::table('roles', function (Blueprint $table) {
            $table->dropForeign(['creado_por']);
            $table->dropForeign(['actualizado_por']);
        });
    }
};
