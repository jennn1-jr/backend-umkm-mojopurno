<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$umkms = DB::table('umkms')->get();
foreach($umkms as $umkm) {
    $cat = $umkm->kategori;
    // Remove the known emoji strings
    $cat = str_replace('👞  Alas Kaki', 'Alas Kaki', $cat);
    $cat = str_replace('🍽️  Makanan', 'Makanan', $cat);
    $cat = str_replace('🎨  Kerajinan Kulit', 'Kerajinan Kulit', $cat);
    $cat = str_replace('📦  Lainnya', 'Lainnya', $cat);
    $cat = str_replace('👞 Alas Kaki', 'Alas Kaki', $cat);
    $cat = str_replace('🍽️ Makanan', 'Makanan', $cat);
    
    // Also remove any rogue star emojis if any
    $cat = str_replace('✨', '', $cat);

    DB::table('umkms')->where('id', $umkm->id)->update(['kategori' => $cat]);
}

echo "Done cleaning db\n";
