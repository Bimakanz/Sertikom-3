<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    // angka dasar
    $siswaCount = Siswa::count();
    $jurusanCount = Jurusan::count();
    $kelasCount = Kelas::count();
    $userCount = User::count();

    // pendistribusian jurusan
    $jurusanDistribusi = Jurusan::withCount('siswa')->get();

    // pendistribusian level kelas
    $kelasDistribusi = Kelas::select('level_kelas')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('level_kelas')
        ->get();

    // recent activity (ambil dari log / model)
    $recentActivities = ActivityLog::latest()->take(5)->get();

    return view('dashboard', compact(
        'siswaCount',
        'jurusanCount',
        'kelasCount',
        'userCount',
        'jurusanDistribusi',
        'kelasDistribusi',
        'recentActivities'
    ));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
