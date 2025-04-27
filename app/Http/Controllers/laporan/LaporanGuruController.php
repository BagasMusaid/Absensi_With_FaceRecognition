<?php

namespace App\Http\Controllers\laporan;

use App\Exports\GuruExport;
use App\Http\Controllers\Controller;
use App\Models\presensi\Guru;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class LaporanGuruController extends Controller
{
    protected $mpdf;
    protected $guru;

    public function __construct()
    {
        $this->mpdf = new Mpdf();
        $this->guru = Guru::orderBy('nama_guru', 'asc')->get();
    }

    public function index()
    {
        return view('reports.report_guru.index');
    }

    public function view_pdf()
    {
        $html = view('reports.report_guru.preview', ['datas' => $this->guru])->render();
        $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
        $this->mpdf->Output();
    }

    public function download_pdf()
    {
        $html = view('reports.report_guru.preview', ['datas' => $this->guru])->render();
        $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
        $this->mpdf->Output('data-guru.pdf', 'D');
    }

    public function view_filter(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter;
        $action = $request->action;

        $guruQuery = Guru::query();
        if ($filter == 'nama_guru') {
            $guruQuery->where('nama_guru', 'like', "%$search%");
        } elseif ($filter == 'NIP') {
            $guruQuery->where('NIP', 'like', "%$search%");
        }

        $datas = $guruQuery->get();

        if ($datas->isEmpty()) {
            alert()->error('Data Tidak Ditemukan');
            return redirect()->back();
        }

        $html = view('reports.report_guru.preview', ['datas' => $datas])->render();

        if ($action == 'preview') {
            $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
            $this->mpdf->Output();
        } elseif ($action == 'download') {
            $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
            $this->mpdf->Output('data-guru.pdf', 'D');
        } elseif ($action == 'export-excel') {
            return Excel::download(new GuruExport($datas), 'data-guru.xlsx');
        }
    }

    public function export_excel()
    {
        return Excel::download(new GuruExport($this->guru), 'data-guru.xlsx');
    }
}
