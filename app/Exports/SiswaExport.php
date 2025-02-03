<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SiswaExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $siswa;
    public function __construct($siswa)
    {
        $this->siswa = $siswa;
    }
    public function view(): View
    {
        return view('reports.report_siswa.export_excel', ['datas' => $this->siswa]);
    }
}