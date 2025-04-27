<?php

namespace App\Http\Controllers\laporan;

use App\Exports\MapelExport;
use App\Http\Controllers\Controller;
use App\Models\master_data\Mapel;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Maatwebsite\Excel\Facades\Excel;

class LaporanMapelController extends Controller
{
    protected $mpdf;
    protected $mapel;
    public function __construct()
    {
        $this->mpdf = new Mpdf();
        $this->mapel = Mapel::with('kelas')->orderBy('nama_mapel', 'asc')->get();
    }
    public function index()
    {

        return view('reports.report_mapel.index');
    }
    public function view_pdf()
    {
        $html = view('reports.report_mapel.preview', ['datas' => $this->mapel]);
        $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
        $this->mpdf->Output();
    }
    public function download_pdf()
    {
        $html = view('reports.report_mapel.preview', ['datas' => $this->mapel]);
        $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
        $this->mpdf->Output('laporan_Mata_Pelajaran.pdf', 'D');
    }
    public function export_excel_mapel()
    {
        return Excel::download(new MapelExport($this->mapel), 'data-mata-pelajaran.xlsx');
    }
    public function view_filter(Request $request)
    {
        $search = $request->search;
        $filter_mapel = $request->filter;
        $action = $request->action;

        $mapelQuery = Mapel::with('kelas');
        if ($filter_mapel == 'nama_mapel') {
            $mapelQuery->where('nama_mapel', 'like', "%$search%");
        } elseif ($filter_mapel == 'kelas') {
            $mapelQuery->whereHas('kelas', function ($query) use ($search) {
                $query->where('nama_kelas', 'like', "%$search");
            });
        }
        $datas = $mapelQuery->get();

        if ($datas->isEmpty()) {
            alert()->error('Data Tidak Ditemukan');
            return redirect()->back();
        }

        $html = view('reports.report_mapel.preview', ['datas' => $datas]);

        if ($action == 'preview') {
            $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
            $this->mpdf->Output();
        } elseif ($action == 'download') {
            $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
            $this->mpdf->Output('laporan_mapel.pdf', 'D');
        } elseif ($action == 'export-excel') {
            return Excel::download(new MapelExport($datas), 'laporan_data-mata-pelajaran.xlsx');
        }
    }
}
