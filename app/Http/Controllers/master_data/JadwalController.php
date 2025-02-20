<?php

namespace App\Http\Controllers\master_data;

use App\Http\Controllers\Controller;
use App\Models\master_data\kelas;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $kelasQuery = kelas::with(['walikelas.guru', 'siswa'])->whereHas('walikelas');
        if ($search) {
            $kelasQuery->where(function ($query) use ($search) {
                $query->where('nama_kelas', 'like', "%$search%")
                    ->orWhereHas('walikelas.guru', function ($query) use ($search) {
                        $query->where('nama_guru', 'like', "%$search%");
                    });
            });
        }
        $kelas = $kelasQuery->paginate(5);
        if ($request->ajax()) {
            return view('pages.jadwal.index', compact('kelas'))->render();
        }
        return view('pages.jadwal.index', compact('kelas'));
    }
    public function show_kelas(Request $request, string $id)
    {
        $mapelDetail = kelas::findOrFail($id);
        $search = $request->search;
        $mapelQuery = $mapelDetail->mapel();
        if ($search) {
            $mapelQuery->where(function ($query) use ($search) {
                $query->where('nama_mapel', 'like', "%$search%")
                    ->orWhere('hari', 'like', "%$search%");
            });
        }
        $mapel = $mapelQuery->orderByDesc('hari')->orderBy('jam_mulai', 'ASC')->paginate(5);
        return view('pages.jadwal.detail', compact('mapelDetail', 'mapel'));
    }
}
