<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanSurat extends Model
{
    protected $table = 'pengajuan';
    protected $primaryKey = 'pengajuan_id';
    protected $allowedFields = [
        'pengajuan_id', 'id_user', 'id_pegawai', 'id_balasan', 'tgl_surat', 'tgl_pengajuan', 'tgl_proses', 'tgl_selesai', 'nama_pengaju', 'perihal', 'detail_perihal', 'alamat', 'status_pengajuan', 'status_akhir',
    ];

    public function getPengajuan($pengajuan_id = false)
    {
        if ($pengajuan_id == false) {
            return $this->findAll();
        }

        return $this->where(['pengajuan_id' => $pengajuan_id])->first();
    }
}
