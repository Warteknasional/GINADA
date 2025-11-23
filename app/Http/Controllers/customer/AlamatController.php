<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    public function index()
    {
        $alamat = Alamat::where('user_id', auth()->id())->get();
        return view('customer.alamat.index', compact('alamat'));
    }

    public function create()
    {
        return view('customer.alamat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'nullable|string',
            'penerima' => 'required|string',
            'no_hp' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'nullable|string',
            'is_default' => 'boolean'
        ]);

        if($request->is_default) {
            Alamat::where('user_id',auth()->id())->update(['is_default'=>false]);
        }

        Alamat::create(array_merge($request->all(), ['user_id'=>auth()->id()]));

        return redirect()->route('customer.alamat.index')->with('success','Alamat berhasil ditambahkan');
    }

    public function edit(Alamat $alamat)
    {
        $this->authorize('update',$alamat);
        return view('customer.alamat.edit',compact('alamat'));
    }

    public function update(Request $request, Alamat $alamat)
    {
        $this->authorize('update',$alamat);

        $request->validate([
            'judul' => 'nullable|string',
            'penerima' => 'required|string',
            'no_hp' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'nullable|string',
            'is_default' => 'boolean'
        ]);

        if($request->is_default) {
            Alamat::where('user_id',auth()->id())->update(['is_default'=>false]);
        }

        $alamat->update($request->all());

        return redirect()->route('customer.alamat.index')->with('success','Alamat berhasil diperbarui');
    }

    public function destroy(Alamat $alamat)
    {
        $this->authorize('delete',$alamat);
        $alamat->delete();
        return back()->with('success','Alamat berhasil dihapus');
    }
}
