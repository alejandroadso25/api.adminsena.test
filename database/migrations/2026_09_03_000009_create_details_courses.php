<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Migration retained for existing histories; schedule is no longer used.
     */
    public function up(): void
    {
    }

    /**
     * Does not restore the removed schedule column on rollback.
     */
    public function down(): void
    {
    }
};