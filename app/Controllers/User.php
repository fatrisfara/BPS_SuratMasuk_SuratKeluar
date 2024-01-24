<?php

namespace App\Controllers;

use App\Models\PengajuanSurat;
use CodeIgniter\Database\Query;

class User extends BaseController
{
    protected $db;
    protected $builder;
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->PengajuanSurat = new PengajuanSurat();
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');

        // $this->validation   = \Config\Services::validation();
    }
    public function index()
    {

        $userlogin = user()->id;

        $data = $this->db->table('pengajuan');

        $query1 = $data->where('id_user', $userlogin)->get()->getResult();
        $query2 = $data->where('id_user', $userlogin)->where('status_pengajuan', 'diproses')->get()->getResult();
        $query3 = $data->where('id_user', $userlogin)->where('status_pengajuan', 'selesai')->get()->getResult();
        $semua = count($query1);

        $data = [
            'semua' => $semua,
            'pengajuan' => count($query1),
            'proses_pengajuan' => count($query2),
            'selesai_pengajuan' => count($query3),
            'title' => 'Home',
        ];

        return view('user/home/index', $data);
    }
    public function profil($id = 0)
    {

        // $data['title'] = 'User Profile ';
        $userlogin = user()->username;
        $userid = user()->id;

        $roleData = $this->db->table('auth_groups_users')->where('user_id', $userid)->get()->getRow();

        $adminRoleId = 1;
        $kepalaBpsRoleId = 4;

        if ($roleData) {
            if ($roleData->group_id == $adminRoleId) {
                $role_echo = 'admin';
            } elseif ($roleData->group_id == $kepalaBpsRoleId) {
                $role_echo = 'kepala_bps';
            } else {
                // Tambahkan kondisi untuk peran lain jika diperlukan
                $role_echo = 'user';
            }
        } else {
            $role_echo = 'user';
        }

        $builder = $this->db->table('users');
        $builder->select('id,username,created_at,foto');
        $builder->where('username', $userlogin);
        $query = $builder->get();
        $data = [
            'user' => $query->getRow(),
            'title' => 'Profil - BPS',
            'role' => $role_echo,

        ];

        return view('user/home/profil', $data);
    }


    public function surat_masuk()
    {
        $this->builder = $this->db->table('surat_masuk');
        $this->builder->select('surat_masuk.*, users.username as username');
        $this->builder->join('users', 'users.id = surat_masuk.id', 'left');
$this->builder->where('users.id', user()->id);




        $this->query = $this->builder->get();
        $data['masuk'] = $this->query->getResultArray();
        $data['title'] = 'Surat Masuk';
        $data['validation'] = \Config\Services::validation();



        return view('user/surat_masuk/index', $data);
    }

    //Pengajuan Surat
    public function pengajuan()
    {
        $this->builder = $this->db->table('pengajuan');
        $this->builder->select('*');
        $this->builder->where('id_user', user()->id);
        $this->query = $this->builder->get();
        $data['pengajuan'] = $this->query->getResultArray();
        $data['title'] = 'Surat Keluar';

        return view('user/pengajuan/index', $data);
    }

    public function form()
    {
        $data = [
            'validation' => $this->validation,
            'title' => 'Tambah Pengajuan Surat ',
        ];

        return view('user/pengajuan/tambah_pengajuan', $data);
    }
    public function save_pengajuan()
    {
        if (!$this->validate([
            'perihal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Perihal wajib diisi',

                ],
            ],

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/user/form')->withInput()->with('validation', $validation);
        }

        // Ambil nilai 'tgl_pengajuan' dari formulir
        $date = date("Y/m/d h:i:s");
        $this->PengajuanSurat->save([
            'id_user' => user()->id,
            'tgl_pengajuan' => $date,
            'tgl_surat' => $this->request->getVar('tgl_surat'),
            'perihal' => $this->request->getVar('perihal'),
            'alamat' => $this->request->getVar('alamat'),
            'nama_pengaju' => user()->username,
            'detail_perihal' => $this->request->getVar('detail_perihal'),
            'status_pengajuan' => 'belum diproses',
            // ... kode lainnya ...
        ]);

        // Flashdata pesan disimpan
        session()->setFlashdata('pesanBerhasil', 'Data Berhasil Ditambahkan');

        return redirect()->to('user/pengajuan');
    }

    public function editPengajuan($pengajuan_id)
    {
        session();
        $data = [
            'title' => 'Ubah Data',
            'validation' => \Config\Services::validation(),
            'pengajuan' => $this->PengajuanSurat->getPengajuan($pengajuan_id),
        ];

        return view('user/pengajuan/ubah_pengajuan', $data);
    }
    public function update($pengajuan_id)
    {
        $this->PengajuanSurat->update($pengajuan_id, [
            'perihal' => $this->request->getVar('perihal'),
            'detail_perihal' => $this->request->getVar('detail_perihal'),
            'alamat' => $this->request->getVar('alamat'),
        ]);
        return redirect()->to('/user/pengajuan');
    }

    public function detailajuan($pengajuan_id)
    {

        $data = $this->db->table('pengajuan');
        $data->select('*');
        $data->where('pengajuan_id', $pengajuan_id);
        $query = $data->get();

        // dd($query1);
        $ex = [

            'detail' => $query->getRow(),
            'title' => 'Detail Pengajuan',

        ];

        return view('user/pengajuan/detail_pengajuan', $ex);
    }

    public function hapus($id_pengajuan)
    {
        $this->PengajuanSurat->delete($id_pengajuan);
        session()->setFlashdata('PesanBerhasil', 'Data berhasil terhapus');

        return redirect()->to('/user/pengajuan');
    }
    // End Pengajuan

    public function detail_masuk($no_berkas)
    {
        $data['title'] = 'Detail Surat Masuk';
        $this->builder = $this->db->table('surat_masuk');
        $this->builder->select('surat_masuk.*, users.username as username, jabatan.nama_jabatan');
        $this->builder->join('users', 'users.id = surat_masuk.id', 'left');
        $this->builder->join('jabatan', 'jabatan.id_jabatan = surat_masuk.id_jabatan', 'left');
        $this->builder->where('no_berkas', $no_berkas);


        $query = $this->builder->get();
        $data['surat'] = $query->getRow();

        if (empty($data['surat'])) {
            return redirect()->to('/admin/surat_masuk');
        }
        return view('user/surat_masuk/detail_surat', $data);
    }
}
