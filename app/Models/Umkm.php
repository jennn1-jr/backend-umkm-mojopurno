<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkms';

    protected $fillable = [
        'nama_usaha',
        'nama_pemilik',
        'kategori',
        'deskripsi_usaha',

        'alamat',
        'lokasi',
        'nomor_wa',
        'foto_sampul',
        'link_shopee',
        'link_tokopedia',
        'link_instagram',
        'link_facebook',
        'link_tiktok',
        'map_embed_url',
        'status',
    ];

    public function galleries()
    {
        return $this->hasMany(UmkmGallery::class);
    }
}
