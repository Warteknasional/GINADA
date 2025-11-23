<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::latest()->paginate(10);
        return view('admin.area.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.area.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required|string|unique:area,nama_area',
            'ongkir' => 'required|integer|min:0',
            'catatan' => 'nullable|string'
        ]);

        Area::create($request->all());
        return redirect()->route('admin.area.index')->with('success','Area berhasil ditambahkan');
    }

    public function edit(Area $area)
    {
        return view('admin.area.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'nama_area' => 'required|string|unique:area,nama_area,'.$area->id,
            'ongkir' => 'required|integer|min:0',
            'catatan' => 'nullable|string'
        ]);

        $area->update($request->all());
        return redirect()->route('admin.area.index')->with('success','Area berhasil diperbarui');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return back()->with('success','Area berhasil dihapus');
    }
}
