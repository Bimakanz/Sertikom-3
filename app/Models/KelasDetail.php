<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasDetail extends Model
{
    protected $fillable = [
        'kelas_id',
        'tahun_ajar_id',
        'siswa_id',
        'status',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function tahun_ajar()
    {
        return $this->belongsTo(TahunAjar::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
