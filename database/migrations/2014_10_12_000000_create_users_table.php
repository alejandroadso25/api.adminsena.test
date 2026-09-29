<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla donde se almacenan las cuentas del sistema.
     */
    public function up(): void
    {
        // Esta tabla es utilizada por el modelo App\Models\User para el login.
        Schema::create('users', function (Blueprint $table) {
            
            // Identificador único y autoincremental de cada usuario.
            $table->id();

            // Nombres y apellidos completos del usuario universal.
            $table->string('name');
            $table->string('last_name');

            // Correo usado para iniciar sesión; no puede repetirse.
            $table->string('email')->unique();

            // Datos personales opcionales del perfil.
            $table->string('address')->nullable();
            $table->string('gender')->nullable();

            // Teléfono de contacto del usuario.
            $table->string('phone');

            // Fecha de confirmación del correo; puede quedar vacía.
            $table->timestamp('email_verified_at')->nullable();

            // Contraseña almacenada como hash, nunca como texto plano.
            $table->string('password');

            // Por ahora todas las cuentas usan el rol administrativo.
            $table->string('role')->default('admin')->index();

            // Token opcional para conservar la sesión con la opción "recordarme".
            $table->rememberToken();

            // Registra automáticamente cuándo se creó y modificó la cuenta.
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla users si se revierte esta migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
