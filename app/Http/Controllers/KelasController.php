<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = Kelas::with(['jurusan']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_kelas', 'LIKE', "%{$search}%")
                  ->orWhere('level_kelas', 'LIKE', "%{$search}%")
                  ->orWhereHas('jurusan', function($q) use ($search) {
                      $q->where('nama_jurusan', 'LIKE', "%{$search}%");
                  });
            });
        }

        $kelas = $query->latest()->paginate(5);
        $kelas->appends(['search' => $search]);

        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        return view('Kelas.create', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'level_kelas' => 'required',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        $kelas = Kelas::create($request->all());

        ActivityLog::create([
            'description' => 'Kelas Baru Ditambahkan: ' . $kelas->nama_kelas
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan');
    }

    public function edit(Kelas $kela)
    {
        $jurusan = Jurusan::all();

        return view('kelas.edit', [
            'kelas' => $kela,
            'jurusan' => $jurusan,
        ]);
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'level_kelas' => 'required',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        ActivityLog::create([
            'description' => 'Kelas Diperbarui: ' . $kela->nama_kelas
        ]);

        $kela->update($request->all());

        return redirect()->route('kelas.index');
    }

    public function destroy(Kelas $kelas)
    {
        ActivityLog::create([
            'description' => 'Kelas Di Hapus: ' . $kelas->nama_kelas
        ]);

        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus');
    }
}
