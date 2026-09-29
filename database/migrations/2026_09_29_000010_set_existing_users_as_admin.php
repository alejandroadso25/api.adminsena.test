<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Normaliza las cuentas existentes al único rol disponible.
     */
    public function up(): void
    {
        DB::table('users')->update(['role' => 'admin']);
    }

    /**
     * No se restauran roles anteriores porque dejaron de ser válidos.
     */
    public function down(): void
    {
        // Intencionalmente vacío: los roles anteriores ya no forman parte del sistema.
    }
};