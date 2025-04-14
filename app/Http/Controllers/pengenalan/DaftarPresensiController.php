<?php

namespace App\Http\Controllers\pengenalan;

use App\Http\Controllers\Controller;
use App\Models\pengenalan\Wajah;
use App\Models\presensi\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DaftarPresensiController extends Controller
{
    public function index($id)
    {
        // Cek apakah siswa dengan kd_siswa tersebut ada
        $siswa = Siswa::where('kd_siswa', $id)->first();

        return view('pages.presensi.index', compact('siswa'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'NIS_Siswa' => 'required|exists:siswas,NIS',
                'embeddings' => 'required|array',
                'face_images' => 'required|array',
            ]);

            // Buat folder label sesuai NIS siswa
            $folder = "face-labels/{$request->NIS_Siswa}";
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            foreach ($request->embeddings as $index => $embedding) {
                $imageBase64 = $request->face_images[$index];

                // Bersihkan base64 prefix
                $image = preg_replace('#^data:image/\w+;base64,#i', '', $imageBase64);
                $image = str_replace(' ', '+', $image);
                $imageData = base64_decode($image);

                // Simpan file ke folder per siswa
                $filename = "{$request->NIS_Siswa}_{$index}.jpg";
                $path = "{$folder}/{$filename}";
                Storage::disk('public')->put($path, $imageData);

                // Simpan ke DB
                Wajah::create([
                    'NIS_Siswa' => $request->NIS_Siswa,
                    'embedding' => json_encode($embedding),
                    'face_images' => $path,
                ]);
            }

            return response()->json([
                'message' => 'Data wajah berhasil disimpan.',
                'redirect' => route('siswa.index'),
            ]);
        } catch (\Throwable $th) {
            report($th);
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan wajah.',
            ], 500);
        }
    }
    public function dataWajah()
    {
        $data = Wajah::with('siswa')
            ->get()
            ->map(function ($wajah) {
                return [
                    'NIS_Siswa' => $wajah->NIS_Siswa,
                    'nama_siswa' => $wajah->siswa ? $wajah->siswa->nama_siswa : 'Tidak Diketahui', // Gunakan ternary untuk kejelasan
                    'embedding' => json_decode($wajah->embedding),
                    'face_image' => $wajah->face_images,
                ];
            });

        return response()->json($data);
    }
}
