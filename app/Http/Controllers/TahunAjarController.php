<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\TahunAjar;
use Illuminate\Http\Request;

class TahunAjarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        $search = $request->get('search');
        
        $query = TahunAjar::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_tahun_ajar', 'LIKE', "%{$search}%")
                  ->orWhere('kode_tahun_ajar', 'LIKE', "%{$search}%");
            });
        }
        
        $data = $query->latest()->paginate(3);
        $data->appends(['search' => $search]);
        
        return view('tahunajar.index', compact('data'));
    }

    public function create()
    {
        return view('tahunajar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tahun_ajar' => 'required',
            'kode_tahun_ajar' => 'required|unique:tahun_ajars,kode_tahun_ajar',
        ]);

        $item = TahunAjar::create([
            'nama_tahun_ajar' => $request->nama_tahun_ajar,
            'kode_tahun_ajar' => $request->kode_tahun_ajar,
        ]);

        ActivityLog::create([
            'description' => "Tahun ajar Baru Ditambahkan: {$item->nama_tahun_ajar}"
        ]);

        return redirect()->route('tahunajar.index')->with('success', 'Tahun ajar berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = TahunAjar::findOrFail($id);
        return view('tahunajar.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = TahunAjar::findOrFail($id);

        $request->validate([
            'nama_tahun_ajar' => 'required|unique:tahun_ajars,nama_tahun_ajar,' . $id,
            'kode_tahun_ajar' => 'required|unique:tahun_ajars,kode_tahun_ajar,' . $id,
        ]);

        $oldName = $item->nama_tahun_ajar;

        $item->update([
            'nama_tahun_ajar' => $request->nama_tahun_ajar,
            'kode_tahun_ajar' => $request->kode_tahun_ajar,
        ]);

        ActivityLog::create([
            'description' => "Tahun ajar diperbarui: {$oldName} -> {$item->nama_tahun_ajar}"
        ]);

        return redirect()->route('tahunajar.index')->with('success', 'Tahun ajar berhasil diperbarui');
    }

    public function destroy($id)
    {   
        $item = TahunAjar::findOrFail($id);

        ActivityLog::create([
            'description' => "Tahun ajar Di hapus: {$item->nama_tahun_ajar}"
        ]);

        $item->delete();
        return redirect()->route('tahunajar.index')->with('success', 'Tahun ajar berhasil dihapus');
    }

    /**
     * Update the specified resource in storage.
     */
}