<?php

namespace App\Models;

use CodeIgniter\Model;

class Bagian extends Model
{
    protected $table = 'bagian';
    protected $primaryKey = 'id_bagian';
    protected $allowedFields = [
        'id_bagian', 'nama_bagian',
    ];

    /**
    * Tambahkan user ke bagian.
    *
    * @param int $idBagian
    * @param int $idUser
    * @return bool
    */
    public function tambahUserKeBagian($idBagian, $idUser)
    {
        // Pastikan $idBagian dan $idUser valid
        if (!is_numeric($idBagian) || !is_numeric($idUser)) {
            return false;
        }

        // Perbarui kolom id_bagian di tabel users
        $this->db->table('users')
            ->where('id', $idUser)
            ->update(['id_bagian' => $idBagian]);

        return true;
    }
    
    public function getAll()
    {
        return $this->findAll();
    }
    public function getNamaBagianById($id_bagian)
    {
        $result = $this->find($id_bagian);
        return $result ? $result['nama_bagian'] : null;
    }

    public function save_bagian($data)
    {
        return $this->insert($data);
    }

    public function update_bagian($id, $data)
    {
        return $this->update($id, $data);
    }

    public function delete_bagian($id)
    {
        return $this->delete($id);
    }
}
