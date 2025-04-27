<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PresensiExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $presensi;
    public function __construct($presensi)
    {
        $this->presensi = $presensi;
    }
    public function view(): View
    {
        return view('reports.report_presensi.export_excel', ['datas' => $this->presensi]);
    }
}