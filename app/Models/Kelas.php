<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'nama_kelas',
        'level_kelas',
        'jurusan_id',
        'tahun_ajar_id',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
    public function kelas_details()
    {
        return $this->hasMany(KelasDetail::class);
    }
    public function tahunAjar()
    {
        return $this->belongsTo(\App\Models\TahunAjar::class, 'tahun_ajar_id');
    }
}
