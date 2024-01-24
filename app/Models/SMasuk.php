<?php

namespace App\Models;

use CodeIgniter\Model;

class SMasuk extends Model
{
    protected $table = 'surat_masuk';
    protected $primaryKey = 'no_berkas';
    protected $allowedFields = [
        'no_berkas', 'alamat', 'tgl_surat', 'no_surat', 'perihal', 'no_petunjuk', 'scan_surat', 'status_awal', 'id', 'id_jabatan', 'catatan', 'tgl_diterima_pegawai', 'kepada', 'status_akhir',
    ];

    public function getMasuk($no_berkas = false)
    {
        if ($no_berkas == false) {
            return $this->findAll();
        }

        return $this->where(['no_berkas' => $no_berkas])->first();
    }
    //untuk mendapatkan id
    public function getJabatanById($id_jabatan)
    {
        // Sesuaikan dengan nama kolom dan struktur tabel di database Anda
        $jabatanModel = new Jabatan();
        return $jabatanModel->find($id_jabatan);
    }
}
