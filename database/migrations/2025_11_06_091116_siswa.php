<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Tahunajar;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with(['kelas', 'jurusan', 'tahunajar'])->get();
        return view('siswa.index', compact('siswa'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $tahunajar = Tahunajar::all();
        return view('siswa.create', compact('kelas', 'jurusan', 'tahunajar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:siswas,nisn',
            'nama_lengkap' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusans,id',
            'tahun_ajar_id' => 'required|exists:tahun_ajars,id',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $tahunajar = Tahunajar::all();
        return view('siswa.edit', compact('siswa', 'kelas', 'jurusan', 'tahunajar'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nisn' => 'required|unique:siswas,nisn,' . $siswa->id,
            'nama_lengkap' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusans,id',
            'tahun_ajar_id' => 'required|exists:tahun_ajars,id',
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }
}
