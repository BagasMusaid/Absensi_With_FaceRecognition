<?php

namespace App\Http\Controllers\laporan;

use App\Exports\SiswaExport;
use App\Http\Controllers\Controller;
use App\Models\presensi\Siswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class LaporanSiswaController extends Controller
{
    protected $mpdf;
    protected $siswa;
    public function __construct()
    {
        $this->mpdf = new Mpdf();
        $this->siswa = Siswa::with('kelas')->orderBy('nama_siswa', 'asc')->get();
    }
    public function index()
    {
        return view('reports.report_siswa.index');
    }
    public function preview_pdf()
    {
        $html = view('reports.report_siswa.laporan_pdf', ['datas' => $this->siswa]);
        $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
        $this->mpdf->Output();
    }
    public function download_pdf()
    {
        $html = view('reports.report_siswa.laporan_pdf', ['datas' => $this->siswa]);
        $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
        $this->mpdf->Output('laporan_siswa.pdf', 'D');
    }
    public function export_excel_siswa()
    {
        return Excel::download(new SiswaExport($this->siswa), 'data-siswa.xlsx');
    }
    public function filter(Request $request)
    {
        $search = $request->search;
        $filter_siswa = $request->filter_siswa;
        $action_siswa = $request->action;

        $siswaQuery = Siswa::with('kelas');
        if ($filter_siswa == 'nama_siswa') {
            $siswaQuery->where('nama_siswa', 'like', "%$search%");
        } elseif ($filter_siswa == 'kelas_id') {
            $siswaQuery->whereHas('kelas', function ($query) use ($search) {
                $query->where('nama_kelas', 'like', "%$search");
            });
        }
        $datas = $siswaQuery->get();

        if ($datas->isEmpty()) {
            alert()->error('Data Tidak Ditemukan');
            return redirect()->back();
        }

        $html = view('reports.report_siswa.laporan_pdf', ['datas' => $datas]);

        if ($action_siswa == 'preview') {
            $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
            $this->mpdf->Output();
        } elseif ($action_siswa == 'download') {
            $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
            $this->mpdf->Output('laporan_siswa.pdf', 'D');
        } elseif ($action_siswa == 'export-excel') {
            return Excel::download(new SiswaExport($datas), 'laporan_siswa.xlsx');
        }
    }
}
