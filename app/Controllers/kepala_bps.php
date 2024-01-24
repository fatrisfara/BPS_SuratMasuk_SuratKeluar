<?php

namespace App\Controllers;

use App\Models\Jabatan;
use App\Models\SMasuk;
use App\Models\user;

class kepala_bps extends BaseController
{
    protected $db;
    protected $builder;
    protected $BalasanPengadaan;
    protected $SMasuk;
    public function __construct()
    {
        $this->SMasuk = new SMasuk();
        $this->SMasuk = new \App\Models\SMasuk();

        $this->user = new user();
        $this->Jabatan = new Jabatan();
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
   
    $data = $this->db->table('surat_masuk');

    $query1 = $data->get()->getResult();
    $query2 = $data->where('status_awal', 'Belum disposisi')->get()->getResult();
    $query3 = $data->where('status_awal', 'Sudah Disposisi')->get()->getResult();
    $semua = count($query1);

    $data = [
        'semua' => $semua,
        'surat_masuk' => count($query1),
        'belum_diposisi_surat' => count($query2),
        'sudah_disposisi_surat' => count($query3),
        'title' => 'Home',
    ];
        return view('kepala_bps/home/index', $data);
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

        return view('kepala_bps/home/profil', $data);
    }

    //Fungsional untuk Tambah Disposisi
    public function SuratMasuk()
    {
        $this->builder = $this->db->table('surat_masuk');
        $this->builder->select('surat_masuk.*, users.username as username');
        $this->builder->join('users', 'users.id = surat_masuk.id', 'left');
        $this->query = $this->builder->get();
        $data['masuk'] = $this->query->getResultArray();
        $data['title'] = 'Daftar Disposisi Surat Masuk ';
        return view('kepala_bps/surat_masuk/index', $data);
    }

    public function detailSM($no_berkas)
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
            return redirect()->to('/kepala_bps/SuratMasuk');
        }

        return view('kepala_bps/surat_masuk/detail_surat', $data);
    }

    // Controller
    public function tambah_disposisi($no_berkas)
    {
    
        $suratMasukModel = new SMasuk();
        $userModel = new User();
        $jabatanModel = new Jabatan();

        $surat_masuk_data = $suratMasukModel->getMasuk($no_berkas);
        $daftar_jabatan = $jabatanModel->getAll();
        $daftar_users = $userModel->getAllWithJabatan();

        // Pastikan 'id_jabatan' ada dalam hasil query sebelum mengaksesnya
        $nama_jabatan = '';

        // Check if 'id_jabatan' exists in $surat_masuk_data array
        if (!empty($surat_masuk_data['id_jabatan'])) {
            // Dapatkan informasi jabatan berdasarkan 'id_jabatan'
            $jabatan_info = $jabatanModel->getJabatanById($surat_masuk_data['id_jabatan']);

            // Check if 'nama_jabatan' exists in $jabatan_info array
            if (is_array($jabatan_info) && array_key_exists('nama_jabatan', $jabatan_info)) {
                $nama_jabatan = $jabatan_info['nama_jabatan'];
            }
        }

        $data = [
            'title' => 'Ubah Data',
            'validation' => \Config\Services::validation(),
            'surat_masuk' => $surat_masuk_data,
            'daftar_jabatan' => $daftar_jabatan,
            'daftar_users' => $daftar_users, // Tambahkan daftar pegawai ke dalam data
            'nama_jabatan' => $nama_jabatan,
        ];


        return view('kepala_bps/surat_masuk/tambah_disposisi', $data);
    }

    protected function getUserIdBySelectedPegawai($selectedPegawaiId)
    {
        $userModel = new \App\Models\user(); // Sesuaikan dengan nama model yang digunakan
        $user = $userModel->find($selectedPegawaiId);

        if ($user) {
            return $user['id'];
        }

        return null;
    }

    public function save_disposisi($no_berkas)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'pilih_jabatan' => 'required',
            'pilih_pegawai' => 'required',
         
           
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, redirect kembali dengan flash data error
            return redirect()->to("/kepala_bps/tambah_disposisi/$no_berkas")->with('error', $validation->getErrors());
        }

        // Ambil data dari form
        $data = [
            'catatan' => $this->request->getPost('catatan'),
            'id_jabatan' => $this->request->getPost('pilih_jabatan'),
            'id' => $this->request->getPost('pilih_pegawai'),
   
            // Tambahkan data lain sesuai kebutuhan
        ];

        // Simpan data disposisi menggunakan model yang sesuai
       $suratMasukModel = new SMasuk();
$suratMasukModel->update($no_berkas, $data);
$this->db->table('surat_masuk')->where('no_berkas', $no_berkas)->update(['status_awal' => 'Sudah Disposisi']);


        // Set flash data berhasil
        session()->setFlashdata('msg', 'Disposisi berhasil ditambahkan');

        // Redirect ke halaman tertentu
        return redirect()->to('/kepala_bps/SuratMasuk')->with('success', 'Data berhasil disimpan');


    }
    //Akhir Disposisi

}
