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
        Schema::table('umkms', function (Blueprint $table) {
            $table->string('link_tiktok')->nullable()->after('link_facebook');
            $table->dropColumn('link_gmaps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->string('link_gmaps')->nullable()->after('link_facebook');
            $table->dropColumn('link_tiktok');
        });
    }
};
