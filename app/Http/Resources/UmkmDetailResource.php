<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UmkmDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_umkm' => $this->nama_usaha,
            'nama_pemilik' => $this->nama_pemilik,
            'kategori' => $this->kategori,
            'deskripsi' => $this->deskripsi_usaha,

            'lokasi' => $this->lokasi,
            'alamat' => $this->alamat,
            'foto_url' => $this->foto_sampul,
            'fotos' => $this->galleries->pluck('foto_url'),
            'whatsapp' => $this->nomor_wa,
            'link_shopee' => $this->link_shopee,
            'link_tokopedia' => $this->link_tokopedia,
            'link_instagram' => $this->link_instagram,
            'link_facebook' => $this->link_facebook,
            'link_tiktok' => $this->link_tiktok,
            'map_embed_url' => $this->map_embed_url,
        ];
    }
}
