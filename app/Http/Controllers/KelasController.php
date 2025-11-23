<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
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
        $kelas = Kelas::with('tahunAjar')->latest()->paginate(5);
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

        $kelas = Kelas::create($request->all());

        ActivityLog::create([
            'description' => 'Kelas Baru Ditambahkan: ' . ($kelas->tahunAjar->nama_tahun_ajar ?? $kelas->nama_kelas)
        ]);

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
         ActivityLog::create([
            'description' => 'Kelas Diperbarui: ' . ($kela->tahunAjar->nama_tahun_ajar ?? $kela->nama_kelas)
        ]);

        $kela->update($request->all());

        return redirect()->route('kelas.index');
    }

    public function destroy(Kelas $kelas)
    {   
        ActivityLog::create([
            'description' => 'Kelas Di Hapus: ' . ($kelas->tahunAjar->nama_tahun_ajar ?? $kelas->nama_kelas)
        ]);
        
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus');
    }
}
