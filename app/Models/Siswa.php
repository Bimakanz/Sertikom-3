<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'nisn',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'kelas_id',
        'tahun_ajar_id',
        'jurusan_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function tahun_ajar()
    {
        return $this->belongsTo(TahunAjar::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kelas_details()
    {
        return $this->hasMany(KelasDetail::class);
    }
}
