<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TahunAjar;
use Illuminate\Http\Request;

class TahunAjarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $data = TahunAjar::latest()->get();

        return view('tahunajar.index', compact('data'));
    }

    public function create()
    {
        return view('tahunajar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tahun_ajar' => 'required|unique:tahun_ajars,nama_tahun_ajar',
            'kode_tahun_ajar' => 'required|unique:tahun_ajars,kode_tahun_ajar',
        ]);

        TahunAjar::create([
            'nama_tahun_ajar' => $request->nama_tahun_ajar,
            'kode_tahun_ajar' => $request->kode_tahun_ajar,
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

        $item->update([
            'nama_tahun_ajar' => $request->nama_tahun_ajar,
            'kode_tahun_ajar' => $request->kode_tahun_ajar,]);

        return redirect()->route('tahunajar.index')->with('success', 'Tahun ajar berhasil diperbarui');
    }

    public function destroy($id)
    {
        TahunAjar::findOrFail($id)->delete();
        return redirect()->route('tahunajar.index')->with('success', 'Tahun ajar berhasil dihapus');
    }

    /**
     * Update the specified resource in storage.
     */
}