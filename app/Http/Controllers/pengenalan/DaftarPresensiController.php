<?php

namespace App\Http\Controllers\pengenalan;

use App\Http\Controllers\Controller;
use App\Models\pengenalan\Wajah;
use App\Models\presensi\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

            // Ambil data siswa berdasarkan NIS
            $siswa = Siswa::where('NIS', $request->NIS_Siswa)->first();

            if (!$siswa) {
                return response()->json([
                    'message' => 'Data siswa tidak ditemukan.'
                ], 404);
            }

            $namaSiswa = $siswa->nama_siswa; // Pastikan ini sesuai dengan kolom di tabel siswas
            $nisSiswa = $siswa->NIS;


            // Buat folder label sesuai NIS siswa
            $folder = "face-labels/{$request->NIS_Siswa}";
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }

            $siswaJsonPath = base_path('face_training/siswa.json');

            // Buat folder jika belum ada
            $folderPath = base_path('face_training');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            // Ambil data lama jika file ada
            $data = [];
            if (file_exists($siswaJsonPath)) {
                $data = json_decode(file_get_contents($siswaJsonPath), true);
            }

            // Tambahkan atau update data
            $data[$nisSiswa] = $namaSiswa;

            // Simpan ke file
            file_put_contents($siswaJsonPath, json_encode($data, JSON_PRETTY_PRINT));


            // Gabung label.json
            $labelPath = base_path('face_training/data/labels.json');
            $labelData = [];

            if (file_exists($labelPath)) {
                $labelData = json_decode(file_get_contents($labelPath), true);
            }

            foreach ($request->embeddings as $embedding) {
                $labelData[] = $request->NIS_Siswa;
            }

            file_put_contents($labelPath, json_encode($labelData, JSON_PRETTY_PRINT));

            // Gabung embeddings.json
            $embeddingPath = base_path('face_training/data/embeddings.json');
            $embeddingData = [];

            if (file_exists($embeddingPath)) {
                $embeddingData = json_decode(file_get_contents($embeddingPath), true);
            }

            foreach ($request->embeddings as $embedding) {
                $embeddingData[] = $embedding;
            }

            file_put_contents($embeddingPath, json_encode($embeddingData, JSON_PRETTY_PRINT));



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
                'message' => 'Data wajah berhasil disimpan untuk ' . $namaSiswa,
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

    public function trainModel()
    {
        set_time_limit(0);
        try {
            $output = [];
            $result = null;

            exec('python ' . base_path('face_training/train_model.py') . ' 2>&1', $output, $result);

            if ($result === 0) {
                return response()->json([
                    'message' => 'Model berhasil dilatih!',
                    'output' => $output
                ]);
            } else {
                Log::error('Hasil training: ' . print_r($output, true));
                return response()->json([
                    'message' => 'Training gagal.',
                    'error' => $output,
                    'exit_code' => $result
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
