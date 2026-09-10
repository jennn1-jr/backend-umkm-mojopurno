<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUmkmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_usaha' => 'required|string|min:3|max:255',
            'nama_pemilik' => 'required|string|min:3|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string|min:10|max:1000',
            'alamat' => 'required|string|min:15|max:500',
            'lokasi' => 'required|string|max:255',
            'nomor_wa' => 'required|digits_between:10,15',
            'fotos' => 'nullable|array',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'link_shopee' => 'nullable|url|max:500',
            'link_tokopedia' => 'nullable|url|max:500',
            'link_instagram' => 'nullable|url|max:500',
            'link_facebook' => 'nullable|url|max:500',
            'link_tiktok' => 'nullable|url|max:500',
            'map_embed_url' => 'nullable|string|max:2000',
        ];
    }
}
