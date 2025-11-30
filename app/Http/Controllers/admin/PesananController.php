<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Exports\PesananExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class PesananController extends Controller
{
    public function index()
    {
        return view('admin.pesanan.index', [
            'pesanan' => Pesanan::with('user', 'area')->latest()->paginate(10)
        ]);
    }

    public function show(Pesanan $pesanan)
    {
        return view('admin.pesanan.show', [
            'pesanan' => $pesanan->load('detail.product', 'pembayaran')
        ]);
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate(['status' => 'required|in:pending,diproses,siap,dikirim,selesai,dibatalkan']);
        $pesanan->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan diperbarui');
    }

    public function export()
    {
        return Excel::download(new PesananExport, 'laporan-pesanan.xlsx');
    }
    public function cetakPDF()
    {
        // Ambil data pesanan yang sudah selesai/dibayar (supaya laporannya valid)
        $pesanan = \App\Models\Pesanan::with('user')->whereIn('status', ['dibayar', 'diproses', 'dikirim', 'selesai'])->get();

        // Load View khusus PDF
        $pdf = Pdf::loadView('admin.laporan.pdf', compact('pesanan'));

        // Download file PDF
        return $pdf->download('laporan-penjualan-ginada.pdf');
    }
}
