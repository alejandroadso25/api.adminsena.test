<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        //
    // Ejecuta la migración para registrar imágenes reutilizables
    // en cualquier entidad que las necesite (cursos, instructores, centros, etc.).
    //
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();

            // Identifica la entidad a la que pertenece la imagen.
            $table->unsignedBigInteger('imageable_id');
            $table->string('imageable_type');

            // Ruta física de la imagen dentro de storage.
            $table->string('path');

            // Información útil para mostrar o gestionar la imagen.
            $table->string('file_name');
            $table->string('original_name')->nullable();
            $table->string('alt_text')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            // Optimiza la búsqueda por entidad y permite consultar rapidamente la imagen principal de cada registro relacionado.
            $table->index(['imageable_id', 'imageable_type'], 'images_imageable_index');
            $table->index('is_primary');
        });
    }

        //
    // Revierte la migración si se elimina la funcionalidad de imágenes.
    //
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
