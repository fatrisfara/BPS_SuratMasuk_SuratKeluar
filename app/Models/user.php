<?php

namespace App\Models;

use CodeIgniter\Model;
use \Myth\Auth\Authorization\GroupModel;

class User extends Model
{
    protected $table = 'users';
    // protected $useTimestamps = true;
    protected $primarykey = 'id';
    protected $allowedFields = ['username', 'foto', 'password_hash'];

    public function getUsers($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
    public function getAll()
    {
        $db = db_connect(); // Mengambil koneksi database
    
        $query = $db->table('users')
                    ->select('users.id, users.username, jabatan.nama_jabatan') // Sesuaikan dengan struktur tabel
                    ->join('jabatan', 'users.id_jabatan = jabatan.id_jabatan')
                    ->get();

        return $query->getResultArray();
    }

    public function getAllWithJabatan()
    {
       $db = db_connect();

$query = $db->table('users')
            ->select('users.id, users.username, users.id_jabatan, jabatan.nama_jabatan')
            ->join('jabatan', 'users.id_jabatan = jabatan.id_jabatan')
            ->get();

return $query->getResultArray();

    }
    public function getUsernameById($id)
    {
        $result = $this->db->table('users')->select('username')->where('id', $id)->get()->getRow();
        $username = ($result) ? $result->username : '';

        return $username;
    }

}
