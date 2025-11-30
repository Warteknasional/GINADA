<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PesananExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * Mengambil data dari database
    */
    public function collection()
    {
        // Ambil semua pesanan yang tidak dibatalkan
        return Pesanan::with('user')->get();
    }

    /**
    * Menentukan Judul Kolom (Header) di Excel
    */
    public function headings(): array
    {
        return [
            'ID Pesanan',
            'Tanggal',
            'Nama Customer',
            'Email',
            'Alamat Pengiriman',
            'Status',
            'Total Belanja (Rp)',
        ];
    }

    /**
    * Memetakan data per baris
    */
    public function map($pesanan): array
    {
        return [
            $pesanan->kode_pesanan,
            $pesanan->created_at->format('d-m-Y'),
            $pesanan->user->name,
            $pesanan->user->email,
            $pesanan->alamat_kirim,
            $pesanan->status,
            $pesanan->total_harga,
        ];
    }
}