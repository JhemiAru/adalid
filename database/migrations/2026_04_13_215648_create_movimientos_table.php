<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('producto_id')->constrained('productos');
            $table->foreignId('almacen_id')->constrained('almacenes');
            $table->foreignId('ubicacion_id')->nullable()->constrained('ubicaciones');

            $table->enum('tipo_movimiento', ['entrada', 'salida', 'traslado']);
            $table->integer('cantidad');
            $table->string('referencia')->nullable();
            $table->date('fecha');

            $table->foreignId('usuario_id')->constrained('users');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};