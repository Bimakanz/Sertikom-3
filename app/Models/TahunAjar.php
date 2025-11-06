<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TahunAjar extends Model
{

    protected $fillable = [
        'nama_tahun_ajar',
        'kode_tahun_ajar',
    ];
    public  function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    public function kelas_details()
    {
        return $this->hasMany(KelasDetail::class);
    }
}
