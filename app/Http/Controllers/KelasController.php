<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $data = Kelas::with('jurusan')->latest()->get();
        return view('kelas.index', compact('data'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        return view('kelas.create', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'level_kelas' => 'required|integer',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = Kelas::findOrFail($id);
        $jurusan = Jurusan::all();
        return view('kelas.edit', compact('item', 'jurusan'));
    }

    public function update(Request $request, $id)
    {
        $item = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required',
            'level_kelas' => 'required|integer',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        $item->update($request->all());

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui');
    }

    public function destroy($id)
    {
        Kelas::findOrFail($id)->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus');
    }
}
