<?php

namespace App\Controllers;

use App\Models\SMasuk;

class SuratMasuk extends BaseController
{
    protected $db;
    protected $builder;
    public function __construct()
    {
        $this->SMasuk      = new SMasuk();
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('surat_masuk');
        $this->validation  = \Config\Services::validation();
    }
    // public function index()
    // {
    //     $this->builder = $this->db->table('surat_masuk');
    //     $this->builder->select('*');
    //     $this->query   = $this->builder->get();
    //     $data['masuk'] = $this->query->getResultArray();
    //     $data['title'] = 'Surat Masuk';

    //     return view('admin/surat_masuk/index', $data);
    // }

    // public function form()
    // {
    //     $data = [
    //         'validation' => $this->validation,
    //         'title' => 'Tambah Surat Masuk'
    //     ];

    //     return view('admin/surat_masuk/tambah_surat', $data);
    // }
    // public function save_masuk()
    // {
    //     if (!$this->validate([
    //         'alamat' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Alamat wajib diisi',
    //                 'is_unique' => 'Alamat sudah ada'
    //             ]
    //         ],
    //         'scan_surat' => [
    //             'uploaded[scan_surat]',
    //             'mime_in[scan_surat,image/jpg,image/jpeg,image/png,application/pdf]', // tambahkan tipe scan_surat yang diizinkan sesuai kebutuhan
    //             'max_size[scan_surat,102400]' // ubah ukuran maksimum scan_surat yang diizinkan sesuai kebutuhan (dalam kilobita)
    //         ]
    //     ])) {
    //         $validation = \Config\Services::validation();
    //         return redirect()->to('/SuratMasuk/form')->withInput()->with('validation', $validation);
    //     }

    //     $fileScann = $this->request->getFile('scan_surat');

    //     // Pindahkan file ke folder 'public/uploads' dan simpan path-nya ke dalam database
    //     if ($fileScann) {
    //         $newName = $this->request->getVar('no_surat') . '_' . $this->request->getVar('perihal_surat') . '.' . $fileScann->getExtension();
    //         $fileScann->move('uploads', $newName); // pindahkan file ke folder 'public/uploads'
    //     }

    //     $this->SMasuk->save([
    //         'alamat' => $this->request->getVar('alamat'),
    //         'tgl_surat' => $this->request->getVar('tgl_surat'),
    //         'no_surat' => $this->request->getVar('no_surat'),
    //         'perihal_surat' => $this->request->getVar('perihal_surat'),
    //         'no_petunjuk' => $this->request->getVar('no_petunjuk'),
    //         'status_awal' => 'belum Disposisi',
    //         'catatan' => 'belum',
    //         'scan_surat' => isset($newName) ? base_url('uploads' . $newName) : null, // Sesuaikan base_url sesuai dengan kebutuhan Anda
    //         // ... kode lainnya ...
    //     ]);

    //     // Flashdata pesan disimpan
    //     session()->setFlashdata('pesanBerhasil', 'Data Berhasil Ditambahkan');

    //     return redirect()->to('SuratMasuk');
    // }

    public function edit($no_berkas)
    {
        session();
        $data = [
            'title' => 'Ubah Data',
            'validation' => \Config\Services::validation(),
            'surat_masuk' => $this->SMasuk->getMasuk($no_berkas)
        ];
        return view('admin/surat_masuk/ubah_surat', $data);
    }
    public function update($no_berkas)
    {
        if (!$this->validate([
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat wajib diisi',
                    'is_unique' => 'Alamat sudah ada'
                ]
            ],
            'scan_surat' => [
                'mime_in[scan_surat,image/jpg,image/jpeg,image/png,application/pdf]', // tambahkan tipe scan_surat yang diizinkan sesuai kebutuhan
                'max_size[scan_surat,102400]' // ubah ukuran maksimum scan_surat yang diizinkan sesuai kebutuhan (dalam kilobita)
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to("/SuratMasuk/edit/{$no_berkas}")->withInput()->with('validation', $validation);
        }

        $fileScann = $this->request->getFile('scan_surat');

        // Pindahkan file ke folder 'public/uploads' dan simpan path-nya ke dalam database
        if ($fileScann) {
            if ($fileScann->isValid() && !$fileScann->hasMoved()) {
                $newName = $this->request->getVar('no_surat') . '_' . $this->request->getVar('perihal_surat') . '.' . $fileScann->getExtension();
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
            'perihal_surat' => $this->request->getVar('perihal_surat'),
            'no_petunjuk' => $this->request->getVar('no_petunjuk'),
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

        return redirect()->to('SuratMasuk');
    }


    public function detail($no_berkas)
    {
        $data['title'] = ' Detail';
        $this->builder->select('*');
        $this->builder->where('no_berkas', $no_berkas);
        $query = $this->builder->get();
        $data['surat'] = $query->getRow();

        if (empty($data['surat'])) {
            return redirect()->to('/SuratMasuk');
        }

        return view('admin/surat_masuk/detail_surat', $data);
    }

    public function delete($no_berkas)
    {
        $data = $this->SMasuk->where('no_berkas', $no_berkas)->first();

        if (!$data) {
            // Flashdata pesan gagal ditemukan
            session()->setFlashdata('pesanGagal', 'Data Tidak Ditemukan');
            return redirect()->to('SuratMasuk');
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

        return redirect()->to('SuratMasuk');
    }

    public function register()
    {
        return view('auth/register');
    }
    public function user()
    {
        return view('user/index');
    }
}
