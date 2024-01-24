<?php

namespace App\Controllers;

use App\Models\Jabatan;
use App\Models\PengajuanSurat;
use App\Models\profil;
use App\Models\SKeluar;
use App\Models\SMasuk;
use App\Models\user;
use Config\Services;
use Myth\Auth\Entities\User as AuthUser;
use \Myth\Auth\Controllers\AuthController as BaseController;
use Mpdf\Mpdf;

use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\UserModel;

class Admin extends BaseController
{
    protected $db;
    protected $builder;
    protected $Pegawai;
    public function __construct()
    {
        $this->profil = new profil();
        $this->SMasuk = new SMasuk();
        $this->user = new user();
        $this->authUser = new AuthUser();

        $this->Jabatan = new Jabatan();
        $this->SKeluar = new SKeluar();
        $this->PengajuanSurat = new PengajuanSurat();
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query('
         SELECT
        (SELECT COUNT(*) FROM surat_masuk WHERE status_awal = "Belum disposisi") AS belum_disposisi,
        (SELECT COUNT(*) FROM surat_masuk WHERE status_awal = "Sudah Disposisi") AS sudah_disposisi,
        (SELECT COUNT(*) FROM pengajuan WHERE status_pengajuan = "belum diproses") AS belum_proses_pengajuan,
        (SELECT COUNT(*) FROM pengajuan WHERE status_pengajuan = "proses") AS proses_pengajuan,
        (SELECT COUNT(*) FROM pengajuan WHERE status_pengajuan = "selesai") AS selesai_pengajuan,
        (SELECT COUNT(*) FROM surat_keluar) AS surat_keluar,
        (SELECT COUNT(*) FROM pengajuan) AS pengajuan,
        (SELECT COUNT(*) FROM surat_masuk) AS surat_masuk
        ');

        $result = $query->getRow();

        // Format hasil query ke dalam array
        $data = [
            'title' => 'BPS - Home',
            'belum_disposisi' => $result->belum_disposisi,
            'sudah_disposisi' => $result->sudah_disposisi,
            'belum_proses_pengajuan' => $result->belum_proses_pengajuan,
            'proses_pengajuan' => $result->proses_pengajuan,
            'selesai_pengajuan' => $result->selesai_pengajuan,
            'surat_keluar' => $result->surat_keluar,
            'pengajuan' => $result->pengajuan,
            'surat_masuk' => $result->surat_masuk,
        ];

        return view('admin/home/index', $data);
    }



    public function profil()
    {
        // $data['title'] = 'User Profile ';
        $userlogin = user()->username;
        $userid = user()->id;

        // Mengambil data role dari tabel auth_groups_users
        $roleData = $this->db->table('auth_groups_users')->where('user_id', $userid)->get()->getRow();

        // Memeriksa apakah data role ditemukan
        if ($roleData) {
            // Memeriksa ID role, anggap saja ID role admin adalah 1, dan ID role kepala_bps adalah 4 (sesuaikan dengan struktur tabel Anda)
            $adminRoleId = 1;
            $kepalaBpsRoleId = 3;

            // Menentukan status role berdasarkan ID role
            if ($roleData->group_id == $adminRoleId) {
                $role_echo = 'admin';
            } elseif ($roleData->group_id == $kepalaBpsRoleId) {
                $role_echo = 'kepala_bps';
            } else {
                $role_echo = 'user';
            }
        } else {
            // Jika data role tidak ditemukan, mengatur nilai default sebagai 'user'
            $role_echo = 'user';
        }

        $data = $this->db->table('pengajuan');
        $query1 = $data->where('id_user', $userid)->get()->getResult();
        $builder = $this->db->table('users');
        $builder->select('id,username,created_at,foto');
        $builder->where('username', $userlogin);
        $query = $builder->get();
        $semua = count($query1);
        $data = [
            'semua' => $semua,
            'user' => $query->getRow(),
            'title' => 'Profil - BPS',
            'role' => $role_echo,

        ];
        return view('admin/home/profile', $data);
    }

    public function simpanProfile($id)
    {
        $userlogin = user()->username;
        $builder = $this->db->table('users');
        $builder->select('*');
        $query = $builder->where('username', $userlogin)->get()->getRowArray();

        $foto = $this->request->getFile('foto');
        if ($foto->getError() == 4) {
            // No new photo uploaded, update other information only
            $this->profil->update($id, [
                'username' => $this->request->getPost('username'),
            ]);
        } else {
            // New photo uploaded, update information and photo
            $nama_foto = 'UserFoto_' . $this->request->getPost('username') . '.' . $foto->guessExtension();

            // Check if the current user has an existing photo
            if (!(empty($query['foto']))) {
                // Remove the comment below if you want to keep the existing photo
                // unlink('uploads/profile/' . $query['foto']);
            }

            $foto->move('uploads/profile', $nama_foto);

            $this->profil->update($id, [
                'username' => $this->request->getPost('username'),
                'foto' => $nama_foto,
            ]);
        }

        session()->setFlashdata('msg', 'Profil Pengaduan berhasil Diubah');
        return redirect()->to('/admin');
    }

    public function detail_pengguna($id)
    {
        $data['title'] = 'Detail Pengguna - BPS';

        // Mendapatkan data role dari tabel auth_groups_users
        $roleData = $this->db->table('auth_groups_users')->where('user_id', $id)->get()->getRow();

        // Memeriksa apakah data role ditemukan
        if ($roleData) {
            // Memeriksa ID role, anggap saja ID role admin adalah 1, dan ID role kepala_bps adalah 3 (sesuaikan dengan struktur tabel Anda)
            $adminRoleId = 1;
            $kepalaBpsRoleId = 3;

            // Menentukan status role berdasarkan ID role
            if ($roleData->group_id == $adminRoleId) {
                $role = 'admin';
            } elseif ($roleData->group_id == $kepalaBpsRoleId) {
                $role = 'kepala_bps';
            } else {
                $role = 'user';
            }
        } else {
            // Jika data role tidak ditemukan, mengatur nilai default sebagai 'user'
            $role = 'user';
        }

        // Menggabungkan variabel $role ke dalam data
        $data['role'] = $role;

        $query = $this->db->table('users')
            ->select('users.id as userid, username, foto, name, created_at')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('users.id', $id)
            ->get();

        $data['users'] = $query->getRow();

        // Cek apakah user ditemukan
        if (empty($data['users'])) {
            return redirect()->to('/admin');
        }
        return view('admin/pengguna/detail_pengguna', $data);
    }

    //tambah_pengguna
    public function kelola_pengguna()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();

        $groupModel = new GroupModel();

        foreach ($data['users'] as $kelola) {
            $dataKelola['group'] = $groupModel->getGroupsForUser($kelola->id);
            $dataKelola['kelola'] = $kelola;
            $data['kelola' . $kelola->id] = view('admin/k_pengguna/kelola', $dataKelola);
        }
        $data['groups'] = $groupModel->findAll();
        $data['title'] = 'Kelola Pengguna';
        return view('admin/k_pengguna/index', $data);
    }

    public function tambah_user()
    {
        $jabatanModel = new Jabatan();
        $data['jabatanOptions'] = $jabatanModel->findAll();


        $data['title'] = 'BPS - Tambah Pengguna';

        return view('/admin/k_pengguna/tambah', $data);
    }

    public function changeGroup()
    {
        $userId = $this->request->getVar('id');
        $groupId = $this->request->getVar('group');
        $groupModel = new GroupModel();
        $groupModel->removeUserFromAllGroups(intval($userId));
        $groupModel->addUserToGroup(intval($userId), intval($groupId));
        return redirect()->to(base_url('/admin/kelola_user'));
    }

    public function changePassword()
    {
        $userId = $this->request->getVar('user_id');

        $password_baru = $this->request->getVar('password_baru');
        $userModel = new \App\Models\User();
        $user = $userModel->getUsers($userId);
        // $dataUser->update($userId, ['password_hash' => password_hash($password_baru, PASSWORD_DEFAULT)]);
        $userEntity = new AuthUser($user);
        $userEntity->password = $password_baru;
        $userModel->save($userEntity);
        return redirect()->to(base_url('admin/kelola_pengguna'));
    }

    public function activateUser($id, $active)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user) {
            $userModel->update($id, ['active' => $active]);
            return redirect()->back()->with('success', 'Status pengguna berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }
    }
    // end tambah pengguna
    //Surat Masuk
    public function surat_masuk()
    {
        $this->builder = $this->db->table('surat_masuk');
        $this->builder->select('surat_masuk.*, users.username as username');
        $this->builder->join('users', 'users.id = surat_masuk.id', 'left');
        $this->query = $this->builder->get();
        $data['masuk'] = $this->query->getResultArray();
        $data['title'] = 'Surat Masuk';
        $data['validation'] = \Config\Services::validation();

        return view('admin/surat_masuk/index', $data);
    }

    public function form_masuk()
    {
        $surat_masuk = [
            'no_surat' => '',
        ];

        $data = [
            'validation' => $this->validation,
            'title' => 'Tambah Surat Masuk',
            'surat_masuk' => $surat_masuk,
        ];

        return view('admin/surat_masuk/tambah_surat', $data);
    }
    // public function save_masuk()
    // {
    //     // Validasi input
    //     $validation = \Config\Services::validation();
    //     $validation->setRules([
    //         'alamat' => 'required',
    //         'tgl_surat' => 'required',
    //         'no_surat' => 'required',
    //         'perihal' => 'required',
    //         'scan_surat' => 'uploaded[scan_surat]|max_size[scan_surat,1024]|ext_in[scan_surat,pdf]',
    //     ]);

    //     if (!$validation->withRequest($this->request)->run()) {
    //         // Jika validasi gagal, redirect kembali dengan flash data error
    //         return redirect()->back()->withInput()->with('error', $validation->getErrors());
    //     }

    //     // Ambil data dari form
    //     $date = date("Y/m/d h:i:s");

    //     $data = [
    //         'alamat' => $this->request->getVar('alamat'),
    //         'tgl_surat' => $this->request->getVar('tgl_surat'),
    //         'no_surat' => $this->request->getVar('no_surat'),
    //         'no_petunjuk' => $date,
    //         'perihal' => $this->request->getVar('perihal'),
    //         'status_awal' => 'Belum Disposisi',
    //         'catatan' => 'belum',
    //     ];

    //     $fileScan = $this->request->getFile('scan_surat');

    //     // Pindahkan file ke folder 'public/uploads'
    //     if ($fileScan->isValid() && !$fileScan->hasMoved()) {
    //         // Generate nama baru untuk file yang diunggah berdasarkan tgl_surat
    //         $tglSurat = date("Ymd", strtotime($this->request->getVar('tgl_surat')));
    //         $newName = $tglSurat . '_' . $this->request->getVar('no_surat') . '_' . $this->request->getVar('perihal') . '.' . $fileScan->getExtension();

    //         $fileScan->move('uploads', $newName);

    //         // Simpan nama file ke dalam database atau lakukan operasi lain sesuai kebutuhan
    //         $data['scan_surat'] = $newName;
    //     }

    //     // Simpan data ke dalam database
    //     $suratMasukModel = new SMasuk();
    //     $suratMasukModel->insert($data);

    //     // Set flash data berhasil
    //     session()->setFlashdata('msg', 'Data surat masuk berhasil ditambahkan');

    //     // Redirect ke halaman tertentu
    //     return redirect()->to('/admin/surat_masuk')->with('success', 'Data berhasil ditambahkan');
    // }
    public function save_masuk()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'alamat' => 'required',
            'tgl_surat' => 'required',
            'no_surat' => 'required',
            'perihal' => 'required',
            'scan_surat' => 'uploaded[scan_surat]|max_size[scan_surat,51200]|ext_in[scan_surat,pdf]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, redirect kembali dengan flash data error
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        // Ambil data dari form
        $date = date("Y/m/d h:i:s");

        $data = [
            'alamat' => $this->request->getVar('alamat'),
            'tgl_surat' => $this->request->getVar('tgl_surat'),
            'no_surat' => $this->request->getVar('no_surat'),
            'no_petunjuk' => $date,
            'perihal' => $this->request->getVar('perihal'),
            'status_awal' => 'Belum Disposisi',
            'catatan' => 'belum',
        ];

        $fileScan = $this->request->getFile('scan_surat');

        // Pindahkan file ke folder 'public/uploads'
        if ($fileScan->isValid() && !$fileScan->hasMoved()) {
            // Generate nama baru untuk file yang diunggah berdasarkan tgl_surat
            $tglSurat = date("Ymd", strtotime($this->request->getVar('tgl_surat')));
            $newName = $tglSurat . '_' . $this->request->getVar('no_surat') . '_' . $this->request->getVar('perihal') . '.' . $fileScan->getExtension();

            $fileScan->move('uploads', $newName);

            // Simpan nama file ke dalam database atau lakukan operasi lain sesuai kebutuhan
            $data['scan_surat'] = $newName;
        }

        // Simpan data ke dalam database
        $suratMasukModel = new SMasuk();
        $suratMasukModel->insert($data);

        // Set flash data berhasil
        session()->setFlashdata('msg', 'Data surat masuk berhasil ditambahkan');

        // Redirect ke halaman tertentu
        return redirect()->to('/Admin/surat_masuk')->with('success', 'Data berhasil ditambahkan');
    }


    // public function save_masuk()
    // {
    //     // Validasi input
    //     // Jalur 1
    //     $validation = \Config\Services::validation();
    //     $validation->setRules([
    //         'alamat' => 'required',
    //         'tgl_surat' => 'required',
    //         'no_surat' => 'required',
    //         'perihal' => 'required',
    //         'scan_surat' => 'uploaded[scan_surat]|max_size[scan_surat,1024]|ext_in[scan_surat,pdf]',
    //     ]);
    //     //jalur 2 
    //     if (!$validation->withRequest($this->request)->run()) {
    //         // Jika validasi gagal, redirect kembali dengan flash data error
    //         // Jalur 3
    //         return redirect()->back()->withInput()->with('error', $validation->getErrors());
    //     }

    //     // Ambil data dari form
    //     // Jalur 4
    //     $date = date("Y/m/d h:i:s");

    //     $data = [
    //         'alamat' => $this->request->getVar('alamat'),
    //         'tgl_surat' => $this->request->getVar('tgl_surat'),
    //         'no_surat' => $this->request->getVar('no_surat'),

    //         'no_petunjuk' => $date,
    //         'perihal' => $this->request->getVar('perihal'),
    //         'status_awal' => 'Belum Disposisi',
    //         'catatan' => 'belum',
    //     ];

    //     $fileScan = $this->request->getFile('scan_surat');

    //     // Jalur 5
    //     // Pindahkan file ke folder 'writable/uploads'
    //     if ($fileScan->isValid() && !$fileScan->hasMoved())
    //     // Generate nama baru untuk file yang diunggah
    //     // Jalur 6
    //     {
    //         $newName = $this->request->getVar('no_surat') . '_' . $this->request->getVar('perihal') . '.' . $fileScan->getExtension();

    //         $fileScan->move(WRITEPATH . 'uploads', $newName);

    //         // Simpan nama file ke dalam database atau lakukan operasi lain sesuai kebutuhan

    //         $data['scan_surat'] = $newName;
    //     }
    //     // Jalur 7
    //     // Simpan data ke dalam database
    //     $suratMasukModel = new SMasuk();
    //     $suratMasukModel->insert($data);

    //     // Set flash data berhasil
    //     session()->setFlashdata('msg', 'Data surat masuk berhasil ditambahkan');

    //     // Redirect ke halaman tertentu
    //     return redirect()->to('/admin/surat_masuk')->with('success', 'Data berhasil ditambahkan');

    //     //jalur 8
    // }
    public function showFile($filename)
    {
        $file = WRITEPATH . 'uploads/' . $filename;

        if (file_exists($file)) {
            $data['filename'] = $filename;
            return view('uploads/show_file', $data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the file: ' . $filename);
        }
    }

    public function show($filename)
    {
        return view('uploads/show_file', ['filename' => $filename]);
    }


    public function edit_masuk($no_berkas)
    {
        session();
        $data = [
            'title' => 'Edit Data',
            'validation' => \Config\Services::validation(),
            'surat_masuk' => $this->SMasuk->getMasuk($no_berkas),
        ];
        return view('admin/surat_masuk/ubah_surat', $data);
    }

    public function update_masuk($no_berkas)
    {
        if (!$this->validate([
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat wajib diisi',
                    'is_unique' => 'Alamat sudah ada',
                ],
            ],
            'scan_surat' => [
                'mime_in[scan_surat,application/pdf]', // tambahkan tipe scan_surat yang diizinkan sesuai kebutuhan
                'max_size[scan_surat,102400]', // ubah ukuran maksimum scan_surat yang diizinkan sesuai kebutuhan (dalam kilobita)
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to("/admin/edit_masuk/{$no_berkas}")->withInput()->with('validation', $validation);
        }

        $fileScann = $this->request->getFile('scan_surat');

        // Pindahkan file ke folder 'public/uploads' dan simpan path-nya ke dalam database
        if ($fileScann) {
            if ($fileScann->isValid() && !$fileScann->hasMoved()) {
                $newName = $this->request->getVar('no_surat') . '_' . $this->request->getVar('perihal') . '.' . $fileScann->getExtension();
                $fileScann->move(WRITEPATH . 'uploads', $newName); // pindahkan file ke folder 'writable/uploads'
            } else {
                // Log pesan kesalahan jika file tidak dapat dipindahkan
                log_message('error', 'File gagal diproses: ' . $fileScann->getErrorString());
            }
        }
        $date = date("Y/m/d h:i:s");
        $dataToUpdate = [
            'alamat' => $this->request->getVar('alamat'),
            'no_petunjuk' => $date,
            'tgl_surat' => $this->request->getVar('tgl_surat'),
            'no_surat' => $this->request->getVar('no_surat'),
            'perihal' => $this->request->getVar('perihal'),
            'scan_surat' => isset($newName) ? $newName : null,
            'status_awal' => 'belum Disposisi',
            'catatan' => 'belum',
        ];

        if (isset($newName)) {
            // Hapus file yang lama jika ada
            $oldScanSurat = $this->SMasuk->find($no_berkas)['scan_surat'];
            if ($oldScanSurat && file_exists(WRITEPATH . 'uploads/' . $oldScanSurat)) {
                unlink(WRITEPATH . 'uploads/' . $oldScanSurat);
            }
            $dataToUpdate['scan_surat'] = base_url('uploads/' . $newName); // Sesuaikan base_url sesuai dengan kebutuhan Anda
        }

        $this->SMasuk->update($no_berkas, $dataToUpdate);

        // Flashdata pesan berhasil diupdate
        session()->setFlashdata('pesanBerhasil', 'Data Berhasil Diubah');

        return redirect()->to('admin/surat_masuk');
    }

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
        return view('admin/surat_masuk/detail_surat', $data);
    }

    public function delete_masuk($no_berkas)
    {
        $data = $this->SMasuk->where('no_berkas', $no_berkas)->first();

        if (!$data) {
            // Flashdata pesan gagal ditemukan
            session()->setFlashdata('pesanGagal', 'Data Tidak Ditemukan');
            return redirect()->to('admin/surat_masuk');
        }

        // Hapus file terkait
        $scanSurat = $data['scan_surat'];
        if ($scanSurat && file_exists(WRITEPATH . 'uploads/' . $scanSurat)) {
            unlink(WRITEPATH . 'uploads/' . $scanSurat);
        }

        // Hapus data dari database
        $this->SMasuk->where('no_berkas', $no_berkas)->delete();

        // Flashdata pesan berhasil dihapus
        session()->setFlashdata('pesanBerhasil', 'Data Berhasil Dihapus');

        return redirect()->to('admin/surat_masuk');
    }

    //pengajuan
    public function pengajuan()
    {
        $this->builder = $this->db->table('pengajuan');
        $this->builder->select('*');
        $this->query = $this->builder->get();
        $data['pengajuan'] = $this->query->getResultArray();
        $data['title'] = 'Surat pengajuan';

        return view('admin/pengajuan/index', $data);
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

        return view('admin/pengajuan/detail_pengajuan', $ex);
    }

    public function prosesPengajuan($pengajuan_id)
    {
        $date =
            $this->PengajuanSurat->update($pengajuan_id, [
                'tgl_selesai' => date("Y-m-d h:i:s"),
                'status_pengajuan' => 'diproses',

            ]);
        session()->setFlashdata('msg', 'Status permintaan berhasil Diubah');
        return redirect()->to('admin/detailajuan/' . $pengajuan_id);
    }

    public function terimaPengajuan($pengajuan_id)
    {

        $this->PengajuanSurat->update($pengajuan_id, [
            'tgl_selesai' => date("Y-m-d h:i:s"),
            'status_pengajuan' => 'selesai',
            'status_akhir' => 'selesai dibuat',

        ]);
        session()->setFlashdata('msg', 'Status permntaan berhasil Diubah');
        return redirect()->to('admin/detailajuan/' . $pengajuan_id);
    }
    // Akhir Pengajuan

    //Surat Keluar
    public function surat_keluar()
    {
        $this->builder = $this->db->table('surat_keluar');
        $this->builder->select('*');
        $this->query = $this->builder->get();
        $data['keluar'] = $this->query->getResultArray();
        $data['title'] = 'Surat Keluar - BPS';

        return view('admin/surat_keluar/index', $data);
    }

    public function form_keluar()
    {
        $data = [
            'validation' => $this->validation,
            'title' => 'Tambah Surat Keluar',
        ];

        return view('admin/surat_keluar/tambah_surat', $data);
    }

    // public function save_keluar()
    // {
    //     if (!$this->validate([
    //         'alamat' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'alamat wajib diisi',
    //                 'is_unique' => 'alamat sudah ada',
    //             ],
    //         ],
    //         'scan_surat' => [
    //             'uploaded[scan_surat]',
    //             'mime_in[scan_surat,image/jpg,image/jpeg,image/png,application/pdf]', // tambahkan tipe scan_surat yang diizinkan sesuai kebutuhan
    //             'max_size[scan_surat,102400]', // ubah ukuran maksimum scan_surat yang diizinkan sesuai kebutuhan (dalam kilobita)
    //         ],
    //     ])) {
    //         $validation = \Config\Services::validation();
    //         return redirect()->to('/admin/form_keluar')->withInput()->with('validation', $validation);
    //     }

    //     $fileScann = $this->request->getFile('scan_surat');

    //     if ($fileScann) {
    //         $newName = $this->request->getVar('no_surat') . '_' . $this->request->getVar('perihal') . '.' . $fileScann->getExtension();
    //         $fileScann->move('uploads', $newName); // pindahkan file ke folder 'public/uploads'
    //     }

    //     $date = date("Y/m/d h:i:s");
    //     $this->SKeluar->save([
    //         'alamat' => $this->request->getVar('alamat'),
    //         'tgl_surat' => $this->request->getVar('tgl_surat'),
    //         'no_surat' => $this->request->getVar('no_surat'),
    //         'perihal' => $this->request->getVar('perihal'),
    //         'no_petunjuk' => $date,
    //         'status_awal' => 'belum_disposisi',
    //         'catatan' => '-',
    //         'scan_surat' => isset($newName) ? base_url('uploads' . $newName) : null, // Sesuaikan base_url sesuai dengan kebutuhan
    //     ]);

    //     // Flashdata pesan disimpan
    //     session()->setFlashdata('pesanBerhasil', 'Data Berhasil Ditambahkan');

    //     return redirect()->to('admin/surat_keluar');
    // }
    public function save_keluar()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'alamat' => 'required|is_unique[surat_keluar.alamat]',
            'tgl_surat' => 'required',
            'no_surat' => 'required',
            'perihal' => 'required',
            'scan_surat' => 'uploaded[scan_surat]|mime_in[scan_surat,image/jpg,image/jpeg,image/png,application/pdf]|max_size[scan_surat,102400]',
        ])) {
            // Jika validasi gagal, redirect kembali dengan flash data error
            return redirect()->to('/Admin/form_keluar')->withInput()->with('validation', $validation);
        }

        // Ambil data dari form
        $date = date("Y/m/d h:i:s");

        $data = [
            'alamat' => $this->request->getVar('alamat'),
            'tgl_surat' => $this->request->getVar('tgl_surat'),
            'no_surat' => $this->request->getVar('no_surat'),
            'no_petunjuk' => $date,
            'perihal' => $this->request->getVar('perihal'),
            'status_awal' => 'belum_disposisi',
            'catatan' => '-',
        ];

        $fileScan = $this->request->getFile('scan_surat');

        // Pindahkan file ke folder 'public/uploads'
        if ($fileScan->isValid() && !$fileScan->hasMoved()) {
            // Generate nama baru untuk file yang diunggah berdasarkan tgl_surat
            $tglSurat = date("Ymd", strtotime($this->request->getVar('tgl_surat')));
            $newName = $tglSurat . '_' . $this->request->getVar('no_surat') . '_' . $this->request->getVar('perihal') . '.' . $fileScan->getExtension();

            $fileScan->move('uploads', $newName);

            // Simpan nama file ke dalam database atau lakukan operasi lain sesuai kebutuhan
            $data['scan_surat'] = $newName;
        }

        // Simpan data ke dalam database
        $this->SKeluar->save($data);

        // Set flash data berhasil
        session()->setFlashdata('pesanBerhasil', 'Data berhasil ditambahkan');

        // Redirect ke halaman tertentu
        return redirect()->to('/Admin/surat_keluar');
    }
    // public function save_keluar()
    // {
    //     // Validasi input
    //     $validation = \Config\Services::validation();
    //     if (!$this->validate([
    //         'alamat' => 'required|is_unique[surat_keluar.alamat]',
    //         'tgl_surat' => 'required',
    //         'no_surat' => 'required',
    //         'perihal' => 'required',
    //         'scan_surat' => 'uploaded[scan_surat]|mime_in[scan_surat,image/jpg,image/jpeg,image/png,application/pdf]|max_size[scan_surat,102400]',
    //     ])) {
    //         // Jika validasi gagal, redirect kembali dengan flash data error
    //         return redirect()->to('/admin/form_keluar')->withInput()->with('validation', $validation);
    //     }

    //     // Ambil data dari form
    //     $date = date("Y/m/d h:i:s");

    //     $data = [
    //         'alamat' => $this->request->getVar('alamat'),
    //         'tgl_surat' => $this->request->getVar('tgl_surat'),
    //         'no_surat' => $this->request->getVar('no_surat'),
    //         'no_petunjuk' => $date,
    //         'perihal' => $this->request->getVar('perihal'),
    //         'status_awal' => 'belum_disposisi',
    //         'catatan' => '-',
    //     ];

    //     $fileScan = $this->request->getFile('scan_surat');

    //     // Pindahkan file ke folder 'public/uploads'
    //     if ($fileScan->isValid() && !$fileScan->hasMoved()) {
    //         // Generate nama baru untuk file yang diunggah berdasarkan tgl_surat
    //         $tglSurat = date("Ymd", strtotime($this->request->getVar('tgl_surat')));
    //         $newName = $tglSurat . '_' . $this->request->getVar('no_surat') . '_' . $this->request->getVar('perihal') . '.' . $fileScan->getExtension();

    //         $fileScan->move('uploads', $newName);

    //         // Simpan nama file ke dalam database atau lakukan operasi lain sesuai kebutuhan
    //         $data['scan_surat'] = $newName;
    //     }

    //     // Simpan data ke dalam database
    //     $this->SKeluar->save($data);

    //     // Set flash data berhasil
    //     session()->setFlashdata('pesanBerhasil', 'Data berhasil ditambahkan');

    //     // Redirect ke halaman tertentu
    //     return redirect()->to('/admin/surat_keluar');
    // }


    public function edit_keluar($no_berkas)
    {
        session();
        $data = [
            'title' => 'Edit Data',
            'validation' => \Config\Services::validation(),
            'surat_keluar' => $this->SKeluar->getKeluar($no_berkas),
        ];
        return view('admin/surat_keluar/ubah_surat', $data);
    }

    public function update_keluar($no_berkas)
    {
        if (!$this->validate([
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat wajib diisi',
                    'is_unique' => 'Alamat sudah ada',
                ],
            ],
            'scan_surat' => [
                'mime_in[scan_surat,image/jpg,image/jpeg,image/png,application/pdf]', // tambahkan tipe scan_surat yang diizinkan sesuai kebutuhan
                'max_size[scan_surat,102400]', // ubah ukuran maksimum scan_surat yang diizinkan sesuai kebutuhan (dalam kilobita)
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to("/admin/edit_keluar/{$no_berkas}")->withInput()->with('validation', $validation);
        }

        $fileScann = $this->request->getFile('scan_surat');

        // Pindahkan file ke folder 'public/uploads' dan simpan path-nya ke dalam database
        if ($fileScann) {
            if ($fileScann->isValid() && !$fileScann->hasMoved()) {
                $newName = $this->request->getVar('no_surat') . '_' . $this->request->getVar('perihal') . '.' . $fileScann->getExtension();
                $fileScann->move('uploads', $newName); // pindahkan file ke folder 'public/uploads'
            } else {
                // Log pesan kesalahan jika file tidak dapat dipindahkan
                log_message('error', 'File gagal diproses: ' . $fileScann->getErrorString());
            }
        }

        $dataToUpdate = [
            'alamat' => $this->request->getVar('alamat'),
            'tgl_surat' => $this->request->getVar('tgl_surat'),
            'no_surat' => $this->request->getVar('no_surat'),
            'perihal' => $this->request->getVar('perihal'),
            'catatan' => '-',
        ];

        if (isset($newName)) {
            // Hapus file yang lama jika ada
            $oldScanSurat = $this->SKeluar->find($no_berkas)['scan_surat'];
            if ($oldScanSurat && file_exists(WRITEPATH . 'uploads/' . $oldScanSurat)) {
                unlink(WRITEPATH . 'uploads/' . $oldScanSurat);
            }
            $dataToUpdate['scan_surat'] = base_url('uploads/' . $newName); // Sesuaikan base_url sesuai dengan kebutuhan Anda
        }

        $this->SKeluar->update($no_berkas, $dataToUpdate);

        // Flashdata pesan berhasil diupdate
        session()->setFlashdata('pesanBerhasil', 'Data Berhasil Diupdate');

        return redirect()->to('admin/surat_keluar');
    }

    public function detailSK($no_berkas)
    {
        $data['title'] = 'Detail Surat Keluar';

        // Pastikan $this->builder merujuk ke tabel yang benar
        $this->builder->from('surat_keluar');
        $this->builder->select('*');
        $this->builder->where('no_berkas', $no_berkas);
        $query = $this->builder->get();
        $data['surat'] = $query->getRow();

        if (empty($data['surat'])) {
            return redirect()->to('/admin/surat_keluar');
        }

        return view('admin/surat_keluar/detail_surat', $data);
    }
    public function deleteSK($no_berkas)
    {
        // Ambil data surat keluar berdasarkan no_berkas
        $surat = $this->SKeluar->find($no_berkas);

        // Hapus file scan surat jika ada
        if ($surat['scan_surat'] && file_exists(WRITEPATH . 'uploads/' . $surat['scan_surat'])) {
            unlink(WRITEPATH . 'uploads/' . $surat['scan_surat']);
        }

        // Hapus data surat keluar dari database
        $this->SKeluar->delete($no_berkas);

        // Flashdata pesan berhasil dihapus
        session()->setFlashdata('pesanBerhasil', 'Data Berhasil Dihapus');

        return redirect()->to('admin/surat_keluar');
    }

    //Akhir Surat Keluar

    //pegawai
    public function pengguna()
    {
        $data['title'] = 'Pengguna - BPS';
        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users']  = $users->findAll();

        //join tabel memanggil fungsi
        $this->builder->select('users.id as userid, username, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();
        return view('admin/pengguna/index', $data);
    }
    // akhir pegawai

    //jabatan
    public function jabatan()
    {
        $this->builder = $this->db->table('jabatan');
        $this->builder->select('*');
        $this->query = $this->builder->get();
        $data['jabatan'] = $this->query->getResultArray();
        $data['title'] = 'Jabatan - BPS';

        return view('admin/jabatan/index', $data);
    }

    public function tambah_jabatan()
    {
        $data = [
            'validation' => $this->validation,
            'title' => 'Tambah Jabatan',
        ];

        return view('admin/jabatan/tambah_jabatan', $data);
    }

    public function save_jabatan()
    {
        $data = [
            'nama_jabatan' => $this->request->getVar('nama_jabatan'),
            // tambahkan kolom lain jika ada
        ];

        $jabatanModel = new \App\Models\Jabatan();

        if (!$jabatanModel->save_jabatan($data)) {

            $errors = $jabatanModel->errors();
            print_r($errors); // Tampilkan pesan kesalahan
        } else {
            // Jika penyimpanan berhasil, lakukan sesuatu (contoh: redirect)
            return redirect()->to('/admin/jabatan')->with('msg', 'Data berhasil disimpan');
        }
    }

    public function edit_jabatan($id)
    {
        $jabatanModel = new \App\Models\Jabatan();

        $data['title'] = 'Edit Jabatan';
        $data['jabatan'] = $jabatanModel->find($id);

        return view('admin/jabatan/edit_jabatan', $data);
    }

    public function update_jabatan($id)
    {
        $jabatanModel = new \App\Models\Jabatan();

        $data = [
            'nama_jabatan' => $this->request->getVar('nama_jabatan'),
            // tambahkan kolom lain jika ada
        ];

        if (!$jabatanModel->update_jabatan($id, $data)) {
            // Jika pembaruan gagal, lakukan sesuatu (contoh: tampilkan pesan kesalahan)
            $errors = $jabatanModel->errors();
            print_r($errors); // Tampilkan pesan kesalahan
        } else {
            // Jika pembaruan berhasil, lakukan sesuatu (contoh: redirect)
            return redirect()->to('/admin/jabatan')->with('msg', 'Data berhasil diperbarui');
        }
    }

    public function delete_jabatan($id)
    {
        $jabatanModel = new \App\Models\Jabatan();

        if (!$jabatanModel->delete_jabatan($id)) {
            // Jika penghapusan gagal, lakukan sesuatu (contoh: tampilkan pesan kesalahan)
            $errors = $jabatanModel->errors();
            print_r($errors); // Tampilkan pesan kesalahan
        } else {
            // Jika penghapusan berhasil, lakukan sesuatu (contoh: redirect)
            return redirect()->to('/admin/jabatan')->with('msg', 'Data berhasil dihapus');
        }
    }
    // akhir jabatan
    //Laporan
    public function laporan_SMasuk()
    {
        $data = [
            // 'user'=> $query->getResult(),
            'title' => 'BPS - Laporan',

        ];

        return view('admin/laporan/laporan_masuk', $data);
    }
    public function lap_surat_masuk()
    {
        $tanggalMulai = $this->request->getGet('tanggal_mulai');
        $tanggalAkhir = $this->request->getGet('tanggal_akhir');

        // Validasi tanggal
        if (empty($tanggalMulai) || empty($tanggalAkhir)) {
            return redirect()->to(base_url('admin'))->with('error', 'Tanggal mulai dan tanggal akhir harus diisi.');
        }

        $dateMulai = strtotime($tanggalMulai);
        $dateAkhir = strtotime($tanggalAkhir);

        if ($dateMulai === false || $dateAkhir === false || $dateMulai > $dateAkhir) {
            return redirect()->to(base_url('admin'))->with('error', 'Format tanggal tidak valid atau tanggal mulai melebihi tanggal akhir.');
        }

        $suratMasukModel = new SMasuk();

        // Menggunakan allowedFields untuk memilih kolom yang diizinkan
        $allowedFields = $suratMasukModel->allowedFields;

        $data['suratMasuk'] = $suratMasukModel
            ->select($allowedFields)
            ->where('no_petunjuk >=', $tanggalMulai . ' 00:00:00')
            ->where('no_petunjuk <=', $tanggalAkhir . ' 23:59:59')
            ->findAll();



        $mpdf = new \Mpdf\Mpdf();
        $mpdf->showImageErrors = true;

        $html = view('admin/laporan/hasil_masuk', $data); // Sesuaikan dengan nama view yang benar

        $mpdf->curlAllowUnsafeSslRequests = true;

        // Add a new page with landscape orientation
        $mpdf->AddPage('L');

        $mpdf->WriteHTML($html);

        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('surat_keluar.pdf', 'I');
    }

    public function laporan_SKeluar()
    {
        $data = [
            // 'user'=> $query->getResult(),
            'title' => 'BPS - Laporan',

        ];

        return view('admin/laporan/laporan_keluar', $data);
    }
    public function lap_surat_keluar()
    {
        $tanggalMulai = $this->request->getGet('tanggal_mulai');
        $tanggalAkhir = $this->request->getGet('tanggal_akhir');

        // Validasi tanggal
        if (empty($tanggalMulai) || empty($tanggalAkhir)) {
            return redirect()->to(base_url('admin'))->with('error', 'Tanggal mulai dan tanggal akhir harus diisi.');
        }

        $dateMulai = strtotime($tanggalMulai);
        $dateAkhir = strtotime($tanggalAkhir);

        if ($dateMulai === false || $dateAkhir === false || $dateMulai > $dateAkhir) {
            return redirect()->to(base_url('admin'))->with('error', 'Format tanggal tidak valid atau tanggal mulai melebihi tanggal akhir.');
        }

        $suratKeluarModel = new SKeluar();

        // Menggunakan allowedFields untuk memilih kolom yang diizinkan
        $allowedFields = $suratKeluarModel->allowedFields;

        $data['suratKeluar'] = $suratKeluarModel
            ->select($allowedFields)
            ->where('no_petunjuk >=', $tanggalMulai . ' 00:00:00')
            ->where('no_petunjuk <=', $tanggalAkhir . ' 23:59:59')
            ->findAll();

        // Load library mPDF
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->showImageErrors = true;

        $html = view('admin/laporan/hasil_keluar', $data); // Sesuaikan dengan nama view yang benar

        $mpdf->curlAllowUnsafeSslRequests = true;

        // Add a new page with landscape orientation
        $mpdf->AddPage('L');

        $mpdf->WriteHTML($html);

        // Set the Content-Type header and output the PDF
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('Data_Surat_Keluar.pdf', 'I');
    }
    //
    public function viewPdf($filename)
    {
        $file = FCPATH . 'uploads\\' . $filename;

        if (file_exists($file) && pathinfo($file, PATHINFO_EXTENSION) == 'pdf') {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . $filename . '"');
            readfile($file);
            exit;
        } else {
            return 'File not found or not a PDF. File : ' . $file;
        }
    }
    public function viewPdfK($filename)
    {
        $file = FCPATH . 'uploads\\' . $filename;

        if (file_exists($file) && pathinfo($file, PATHINFO_EXTENSION) == 'pdf') {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . $filename . '"');
            readfile($file);
            exit;
        } else {
            return 'File not found or not a PDF. File : ' . $file;
        }
    }

    public function ekspor($no_berkas)
    {
        ini_set('max_execution_time', 0);
        // Variabel $data digunakan untuk menyimpan informasi judul dan detail surat masuk
        $data['title'] = 'cetak';
        $data['detail'] = $this->SMasuk->where(['no_berkas' => $no_berkas])->first();
        // dd($data['detail']);

        // Tangani kasus ketika tidak ada data yang ditemukan
        if (empty($data['detail'])) {
            return;
        }

        // Inisialisasi objek MPDF untuk pembuatan PDF
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->showImageErrors = true;

        $html = view('admin/surat_masuk/cetak_id', $data); // Sesuaikan dengan nama view yang benar

        $mpdf->curlAllowUnsafeSslRequests = true;
        $mpdf->WriteHTML($html);

        // $mpdf->setPaper('A4', 'landscape');
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('surat_keluar.pdf', 'I');
    }
}
