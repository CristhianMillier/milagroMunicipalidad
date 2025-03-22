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
        Schema::create('plantillas', function (Blueprint $table) {
            $table->id();
            $table->string('mes', 20);
            $table->string('anio', 4);
            $table->decimal('monto_haberes', 10, 2)->unsigned();
            $table->decimal('monto_descuentos', 10, 2)->unsigned();
            $table->decimal('monto_aportes', 10, 2)->unsigned();
            $table->decimal('monto_total', 10, 2)->unsigned();
            $table->tinyInteger('estado')->default(1);
            $table->foreignId('tipo_plantilla_id')->nullable()->constrained('tipo_plantillas')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillas');
    }
};