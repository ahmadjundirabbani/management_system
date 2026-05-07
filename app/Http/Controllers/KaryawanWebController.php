<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KaryawanWebController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all();
        return view('karyawan.index', compact('karyawan'));
    }

    public function exportPdf()
    {
        $karyawan = Karyawan::all();

        // Memanggil view yang sudah kita buat sebelumnya
        $pdf = Pdf::loadView('karyawan.pdf', compact('karyawan'));

        return $pdf->download('laporan_karyawan.pdf');
    }
}
