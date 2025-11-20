<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\TahunAjar;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with('tahunAjar')->latest()->get();
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        $tahunAjar = TahunAjar::all();

        return view('Kelas.create', compact('jurusan', 'tahunAjar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'level_kelas' => 'required',
            'tahun_ajar_id' => 'required|exists:tahun_ajars,id'
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan');
    }

    public function edit(Kelas $kela)
    {
        $jurusan = Jurusan::all();
        $tahunAjar = TahunAjar::all();

        return view('kelas.edit', [
            'kelas' => $kela,
            'jurusan' => $jurusan,
            'tahunAjar' => $tahunAjar
        ]);
    }

    public function update(Request $request, Kelas $kela)
    {
        $kela->update($request->all());

    return redirect()->route('kelas.index');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus');
    }
}
