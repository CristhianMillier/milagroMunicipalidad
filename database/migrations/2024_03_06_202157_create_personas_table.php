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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('dni', 8)->nullable();
            $table->string('sistema_pension', 5)->nullable();
            $table->string('tipo_sistema_pension', 20)->nullable();
            $table->string('cusp', 50)->nullable();
            $table->date('fecha_nacimiento');
            $table->date('fecha_ingreso');
            $table->integer('dias_labor')->unsigned()->default(0);
            $table->foreignId('cargo_id')->nullable()->constrained('cargos')->onDelete('set null');
            $table->foreignId('regimene_id')->nullable()->constrained('regimenes')->onDelete('set null');
            $table->foreignId('contrato_id')->nullable()->constrained('contratos')->onDelete('set null');
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};