<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkmGallery extends Model
{
    use HasFactory;

    protected $fillable = ['umkm_id', 'foto_url'];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
