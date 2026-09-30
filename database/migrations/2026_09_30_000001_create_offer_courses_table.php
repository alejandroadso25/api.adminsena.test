<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Crea las convocatorias sin alterar los datos base de courses. */
    public function up(): void
    {
        Schema::create('offer_courses', function (Blueprint $table) {
            $table->id();
            // Cada oferta pertenece a un curso y se elimina con él.
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            // Datos propios de la convocatoria, no del curso base.
            $table->string('program_name');
            $table->string('training_type')->nullable();
            $table->string('location')->nullable();
            $table->boolean('is_open')->default(true);
            $table->text('description')->nullable();
            $table->string('duration')->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->timestamps();
        });
    }

    /** Se elimina la tabla de ofertas al revertir esta migración. */
    public function down(): void
    {
        Schema::dropIfExists('offer_courses');
    }
};