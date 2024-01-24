<?php

namespace App\Models;

use CodeIgniter\Model;

class SKeluar extends Model
{
    protected $table = 'surat_keluar';
    protected $primaryKey = 'no_berkas';
    protected $allowedFields = [
        'no_berkas',  'alamat', 'tgl_surat', 'perihal', 'no_petunjuk', 'no_surat', 'scan_surat',
    ];

    public function getKeluar($no_berkas = false)
    {
        if ($no_berkas == false) {
            return $this->findAll();
        }

        return $this->where(['no_berkas' => $no_berkas])->first();
    }
}
