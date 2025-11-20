<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $data = Jurusan::latest()->get();
        return view('jurusan.index', compact('data'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|unique:jurusans,nama_jurusan',
            'kode_jurusan' => 'required|unique:jurusans,kode_jurusan',
        ]);

        Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
            'kode_jurusan' => $request->kode_jurusan,
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = Jurusan::findOrFail($id);
        return view('jurusan.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Jurusan::findOrFail($id);

        $request->validate([
            'nama_jurusan' => 'required|unique:jurusans,nama_jurusan,' . $id,
            'kode_jurusan' => 'required|unique:jurusans,kode_jurusan,' . $id,
        ]);

        $item->update([
            'nama_jurusan' => $request->nama_jurusan,
            'kode_jurusan' => $request->kode_jurusan,
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diperbarui');
    }

    public function destroy($id)
    {
        Jurusan::findOrFail($id)->delete();
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus');
    }
}
