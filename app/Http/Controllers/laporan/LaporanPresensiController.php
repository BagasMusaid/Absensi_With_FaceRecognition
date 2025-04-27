<?php

namespace App\Http\Controllers\laporan;

use App\Exports\PresensiExport;
use App\Http\Controllers\Controller;
use App\Models\master_data\Kelas;
use App\Models\presensi\presensi;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use PDF;

class LaporanPresensiController extends Controller
{
    protected $mpdf;
    protected $presensi;
    public function __construct()
    {
        $this->mpdf = new Mpdf();
        $this->presensi = presensi::with('siswa.kelas')->orderBy('tanggal', 'asc')->get();
    }
    public function index()
    {
        $kelas = Kelas::all();
        return view('reports.report_presensi.index', compact('kelas'));
    }
    public function view_pdf()
    {
        $html = view('reports.report_presensi.preview', ['datas' => $this->presensi]);
        $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
        $this->mpdf->Output();
    }
    public function download_pdf()
    {
        $html = view('reports.report_presensi.preview', ['datas' => $this->presensi]);
        $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
        $this->mpdf->Output('laporan_presensi.pdf', 'D');
    }
    public function export_excel_presensi()
    {
        return Excel::download(new PresensiExport($this->presensi), 'data-presensi-siswa.xlsx');
    }
    public function view_filter(Request $request)
    {

        $kelasId = $request->kelas;
        $tanggalAwal = Carbon::createFromFormat('m/d/Y', $request->tanggal_awal)->format('Y-m-d');
        $tanggalAkhir = Carbon::createFromFormat('m/d/Y', $request->tanggal_akhir)->format('Y-m-d');
        $action = $request->action;

        // Cari kelas yang dipilih
        $kelas = Kelas::findOrFail($kelasId);

        $datas = Presensi::whereHas('siswa', function ($q) use ($kelasId) {
            $q->where('kelas_id', $kelasId);
        })
            ->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
            ->with('siswa.kelas')
            ->get();

        $html = view('reports.report_presensi.preview', ['datas' => $datas, 'kelas' => $kelas, 'tanggalAwal' => $tanggalAwal, 'tanggalAkhir' => $tanggalAkhir])->render();
        if ($action == 'preview') {
            $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
            $this->mpdf->Output();
        } elseif ($action == 'download') {
            $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
            $this->mpdf->Output('laporan-presensi-siswa.pdf', 'D');
        } elseif ($action == 'export-excel') {
            return Excel::download(new PresensiExport($datas, $kelas, $tanggalAwal, $tanggalAkhir), 'laporan-siswa.xlsx');
        }

        return back();
    }
}
