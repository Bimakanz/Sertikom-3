<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjar;
use App\Models\KelasDetail;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with(['kelas', 'jurusan', 'tahun_ajar'])->latest()->paginate(5);
        return view('siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('siswa.create', [
            'kelas' => Kelas::all(),
            'jurusan' => Jurusan::all(),
            'tahunajar' => TahunAjar::all(),
        ]);
    }

    public function store(Request $request)
    {

        
        $request->validate([
            'nisn' => 'required|unique:siswas,nisn',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusans,id',
            'tahun_ajar_id' => 'required|exists:tahun_ajars,id',
        ]);
       

        // buat siswa
        $siswa = Siswa::create($request->all());

        // buat riwayat aktif pertama kali
        KelasDetail::create([
            'siswa_id' => $siswa->id,
            'kelas_id' => $request->kelas_id,
            'jurusan_id' => $request->jurusan_id,
            'tahun_ajar_id' => $request->tahun_ajar_id,
            'status' => 'Aktif',
        ]);

         // Catat aktivitas
        ActivityLog::create([
            'description' => "Siswa baru ditambahkan: {$siswa->nama_lengkap}"
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function show($id)
    {
        $siswa = Siswa::with(['kelas', 'jurusan', 'tahun_ajar', 'kelas_details.kelas', 'kelas_details.tahun_ajar'])
            ->findOrFail($id);

        return view('siswa.detailsiswa', compact('siswa'));
    }

    public function edit($id)
    {
        return view('siswa.edit', [
            'siswa' => Siswa::findOrFail($id),
            'kelas' => Kelas::all(),
            'tahunajar' => TahunAjar::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nisn' => 'required|unique:siswas,nisn,' . $id,
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajar_id' => 'required|exists:tahun_ajars,id',
        ]);
        ActivityLog::create([
        'description' => "Data siswa diperbarui: {$siswa->nama_lengkap}"
    ]);
        // update siswa
        $siswa->update($request->all());

        // nonaktifkan riwayat lama
        KelasDetail::where('siswa_id', $siswa->id)
            ->where('status', 'Aktif')
            ->update(['status' => 'Tidak Aktif']);

        // buat riwayat baru
        KelasDetail::create([
            'siswa_id' => $siswa->id,
            'kelas_id' => $request->kelas_id,
            'tahun_ajar_id' => $request->tahun_ajar_id,
            'status' => 'Aktif',
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui');
    }



    public function destroy($id)
    {      
        $siswa = Siswa::findOrFail($id);

        ActivityLog::create([
            'description' => "Siswa dihapus: {$siswa->nama_lengkap}"
        ]);

        
        $siswa->delete();

      

        
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus');
        
    }
}
