<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penjadwalan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PenjadwalanController extends Controller
{
    public function index()
    {
        return view('admin.penjadwalan.index', [
            'jadwal' => Penjadwalan::with('pesanan.user')->latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('admin.penjadwalan.create', [
            'pesanan' => Pesanan::where('status','diproses')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required|exists:pesanan,id',
            'jadwal' => 'required|date',
            'tipe' => 'required|string',
            'status' => 'required|string'
        ]);

        Penjadwalan::create($request->all());
        return redirect()->route('admin.penjadwalan.index')->with('success','Jadwal berhasil dibuat');
    }
}
