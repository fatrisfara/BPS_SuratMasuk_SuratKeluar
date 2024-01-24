<?php

namespace App\Models;

use CodeIgniter\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    protected $allowedFields = [
        'id_jabatan', 'nama_jabatan',
    ];

    /**
    * Tambahkan user ke jabatan.
    *
    * @param int $idjabatan
    * @param int $idUser
    * @return bool
    */
    public function tambahUserKeJabatan($idJabatan, $idUser)
    {
        // Pastikan $idjabatan dan $idUser valid
        if (!is_numeric($idJabatan) || !is_numeric($idUser)) {
            return false;
        }

        // Perbarui kolom id_jabatan di tabel users
        $this->db->table('users')
            ->where('id', $idUser)
            ->update(['id_jabatan' => $idJabatan]);

        return true;
    }
    
    public function getAll()
    {
        return $this->findAll();
    }
    public function getNamaJabatanById($id_jabatan)
    {
        $result = $this->find($id_jabatan);
        return $result ? $result['nama_jabatan'] : null;
    }

    public function save_jabatan($data)
    {
        return $this->insert($data);
    }

    public function update_jabatan($id, $data)
    {
        return $this->update($id, $data);
    }

    public function delete_jabatan($id)
    {
        return $this->delete($id);
    }
}
