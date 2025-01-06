<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function pengurusIndex()
    {
        return view('pengurus.laporan-main');
    }

    public function pemohonIndex()
    {
        return view('pemohon.laporan-main');
    }
}
