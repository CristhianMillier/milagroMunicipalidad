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
        Schema::create('aportes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->decimal('monto', 10, 2)->unsigned();
            $table->dateTime('fecha_hora');
            $table->foreignId('persona_id')->nullable()->constrained('personas')->onDelete('set null');
            $table->foreignId('plantilla_id')->nullable()->constrained('plantillas')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aportes');
    }
};