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
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $query = Siswa::with(['kelas', 'jurusan', 'tahun_ajar']);
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nisn', 'LIKE', "%{$search}%")
                  ->orWhere('nama_lengkap', 'LIKE', "%{$search}%")
                  ->orWhere('alamat', 'LIKE', "%{$search}%")
                  ->orWhereHas('kelas', function($q) use ($search) {
                      $q->where('nama_kelas', 'LIKE', "%{$search}%")
                        ->orWhere('level_kelas', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('jurusan', function($q) use ($search) {
                      $q->where('nama_jurusan', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('tahun_ajar', function($q) use ($search) {
                      $q->where('nama_tahun_ajar', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        $siswa = $query->latest()->paginate(5);
        $siswa->appends(['search' => $search]);
        
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
        $siswa = Siswa::with(['kelas', 'jurusan', 'tahun_ajar'])->findOrFail($id);
        
        // Load kelas_details with pagination
        $kelasDetails = $siswa->kelas_details()
            ->with(['kelas', 'tahun_ajar'])
            ->orderByRaw("CASE WHEN status = 'Aktif' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        $kelas = Kelas::all();
        $tahunajar = TahunAjar::all();
        $jurusan = Jurusan::all();

        return view('siswa.detailsiswa', compact('siswa', 'kelasDetails', 'kelas', 'tahunajar', 'jurusan'));
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

        // Check if this is an update from the detail page (only kelas and tahun ajar)
        if ($request->has('kelas_id') && $request->has('tahun_ajar_id')) {
            // Validate only the fields needed for class/year update
            $request->validate([
                'kelas_id' => 'required|exists:kelas,id',
                'tahun_ajar_id' => 'required|exists:tahun_ajars,id',
            ]);

            // Get jurusan_id from the selected kelas directly
            $kelas = Kelas::findOrFail($request->kelas_id);
            $jurusan_id = $kelas->jurusan_id;

            // Update the main student record with class, year and corresponding jurusan
            $siswa->update([
                'kelas_id' => $request->kelas_id,
                'tahun_ajar_id' => $request->tahun_ajar_id,
                'jurusan_id' => $jurusan_id,
            ]);

            // Nonaktifkan riwayat lama
            KelasDetail::where('siswa_id', $siswa->id)
                ->where('status', 'Aktif')
                ->update(['status' => 'Tidak Aktif']);

            // Buat riwayat baru
            KelasDetail::create([
                'siswa_id' => $siswa->id,
                'kelas_id' => $request->kelas_id,
                'jurusan_id' => $jurusan_id,
                'tahun_ajar_id' => $request->tahun_ajar_id,
                'status' => 'Aktif',
            ]);

            $tahunAjarNama = TahunAjar::find($request->tahun_ajar_id)?->nama_tahun_ajar ?? 'N/A';

            ActivityLog::create([
                'description' => "Kelas dan tahun ajar siswa diperbarui: {$siswa->nama_lengkap} (Kelas: {$kelas->nama_kelas}, Tahun Ajar: {$tahunAjarNama}"
            ]);

            return redirect()->route('siswa.show', $siswa->id)->with('success', 'Kelas dan tahun ajar siswa berhasil diperbarui');

            
        }   else {
            // Standard validation for full edit form (from edit page)
            $request->validate([
                'nisn' => 'required|unique:siswas,nisn,' . $id,
                'nama_lengkap' => 'required',
                'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required',
                'kelas_id' => 'required|exists:kelas,id',
                'jurusan_id' => 'required|exists:jurusans,id',
                'tahun_ajar_id' => 'required|exists:tahun_ajars,id',
            ]);

            $siswa->update($request->all());

            ActivityLog::create([
                'description' => "Data siswa diperbarui: {$siswa->nama_lengkap}"
            ]);

            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui');
        }
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
