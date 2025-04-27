<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MapelExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $mapel;
    public function __construct($mapel)
    {
        $this->mapel = $mapel;
    }
    public function view(): View
    {
        return view('reports.report_mapel.export_excel', ['datas' => $this->mapel]);
    }
}
