<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\UmkmListResource;
use App\Http\Resources\UmkmDetailResource;
use App\Http\Requests\StoreUmkmRequest;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Umkm::with('galleries')->where('status', 'published');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                  ->orWhere('deskripsi_usaha', 'like', "%{$search}%");
            });
        }

        if ($request->has('kategori')) {
            $query->where('kategori', $request->input('kategori'));
        }

        $perPage = $request->input('per_page', 12);
        $umkms = $query->paginate($perPage);

        return UmkmListResource::collection($umkms);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Get the UMKM by ID, usually only published are accessible via this endpoint
        // But let's allow finding it first. If needed, we could add ->where('status', 'published')
        // For now, based on requirements, let's keep it simple or strictly published.
        $umkm = Umkm::with('galleries')->findOrFail($id);

        return new UmkmDetailResource($umkm);
    }

    /**
     * Store a newly created pending resource.
     */
    public function storePending(StoreUmkmRequest $request)
    {
        $data = $request->validated();
        
        $data['deskripsi_usaha'] = $data['deskripsi'];
        unset($data['deskripsi']);

        $data['status'] = 'published';

        if (isset($data['fotos'])) {
            unset($data['fotos']);
        }

        $umkm = Umkm::create($data);

        if ($request->hasFile('fotos')) {
            $isFirst = true;
            foreach ($request->file('fotos') as $file) {
                $path = $file->store('umkm_fotos', 'public');
                $url = url('storage/' . $path);
                
                $umkm->galleries()->create([
                    'foto_url' => $url
                ]);
                
                if ($isFirst) {
                    $umkm->foto_sampul = $url;
                    $umkm->save();
                    $isFirst = false;
                }
            }
        }

        // Kode pengiriman notifikasi ke Telegram
        $pesan = "📢 *PENDAFTAR UMKM BARU!* 📢\n\n";
        $pesan .= "👤 Pemilik: " . $request->nama_pemilik . "\n";
        $pesan .= "🏪 Usaha: " . $request->nama_usaha . "\n";
        $pesan .= "📱 No WA: " . $request->nomor_wa . "\n\n";
        $pesan .= "Segera login ke Supabase / Admin untuk verifikasi data (Ubah status pending menjadi approved).";

        Http::post('https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage', [
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'text' => $pesan,
            'parse_mode' => 'Markdown'
        ]);

        return response()->json([
            'message' => 'Data UMKM berhasil dikirim dan akan ditinjau oleh Admin.'
        ]);
    }
}
