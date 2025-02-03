<?php

namespace App\Exports;

use App\Models\Guru;
use App\Models\presensi\Guru as Gurus;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GuruExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $datas;

    // Constructor to accept data
    public function __construct($datas)
    {
        $this->datas = $datas;
    }

    public function view(): View
    {
        return view('reports.report_guru.export_excel', ['datas' => $this->datas]);
    }
}
