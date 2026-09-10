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
        // Use raw SQL to convert ENUM to VARCHAR in PostgreSQL
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE umkms ALTER COLUMN kategori TYPE VARCHAR(255) USING kategori::text');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back (note: may fail if values exceed enum definitions)
        // \Illuminate\Support\Facades\DB::statement("ALTER TABLE umkms ALTER COLUMN kategori TYPE umkms_kategori_enum USING kategori::umkms_kategori_enum");
    }
};
