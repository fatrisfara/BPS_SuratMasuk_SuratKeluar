<?= $this->extend('kepala_bps/templates/index'); ?>

<?= $this->section('page-content'); ?>
<style>
    .rounded-left {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }

    .rounded-right {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }

    .rounded {
        border-radius: 0.25rem;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg my-5 rounded">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-5">Tambah Disposisi</h1>
                                </div>
                                <?php if (session()->getFlashdata('msg')) : ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-success" role="alert">
                                                <?= session()->getFlashdata('msg'); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <form action="<?= base_url('/kepala_bps/save_disposisi/' . $surat_masuk['no_berkas']) ?>" method="POST">
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" name="alamat" id="input-alamat" class="form-control form-control-user <?= session('errors.alamat') ? 'is-invalid' : '' ?>" value="<?= $surat_masuk['alamat']; ?>" readonly> <?php if (session('errors.alamat')) : ?>
                                            <div id="alamatFeedback" class="invalid-feedback">
                                                <?= session('errors.alamat') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_surat">Tanggal Surat</label>
                                        <input type="date" name="tgl_surat" id="input-tgl_surat" class="form-control form-control-user <?= session('errors.tgl_surat') ? 'is-invalid' : '' ?>" value="<?= $surat_masuk['tgl_surat']; ?>" readonly> <?php if (session('errors.tgl_surat')) : ?>
                                            <div id="tgl_suratFeedback" class="invalid-feedback">
                                                <?= session('errors.tgl_surat') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_surat">No Surat</label>
                                        <input type="text" name="no_surat" id="input-no_surat" class="form-control form-control-user <?= session('errors.no_surat') ? 'is-invalid' : '' ?>" value="<?= $surat_masuk['no_surat']; ?>" readonly> <?php if (session('errors.no_surat')) : ?>
                                            <div id="no_suratFeedback" class="invalid-feedback">
                                                <?= session('errors.no_surat') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="perihal">Perihal Surat</label>
                                        <input type="text" name="perihal" id="input-perihal" class="form-control form-control-user <?= session('errors.perihal') ? 'is-invalid' : '' ?>" value="<?= $surat_masuk['perihal']; ?>" readonly> <?php if (session('errors.perihal')) : ?>
                                            <div id="perihalFeedback" class="invalid-feedback">
                                                <?= session('errors.perihal') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_petunjuk">No Petunjuk Surat</label>
                                        <input type="date" name="no_petunjuk" id="input-no_petunjuk" class="form-control form-control-user <?= session('errors.no_petunjuk') ? 'is-invalid' : '' ?>" value="<?= $surat_masuk['no_petunjuk']; ?>" readonly> <?php if (session('errors.no_petunjuk')) : ?>
                                            <div id="no_petunjukFeedback" class="invalid-feedback">
                                                <?= session('errors.no_petunjuk') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="scan_surat">Scan Surat</label>
                                        <div class="custom-file">
                                            <input type="file" name="scan_surat" id="input-scan_surat" class="custom-file-input" disabled>
                                            <label class="custom-file-label" for="input-scan_surat"></label>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="scan_surat">Scan Surat</label>
                                        <div class="custom-file">
                                            <input type="file" name="scan_surat" id="input-scan_surat" class="custom-file-input" disabled>
                                            <label class="custom-file-label" for="input-scan_surat">
                                                <?php if ($surat_masuk['scan_surat']) : ?>
                                                    <a href="<?= base_url('public/uploads' . $surat_masuk['scan_surat']); ?>" target="_blank">
                                                        <?= basename($surat_masuk['scan_surat']); ?>
                                                    </a>
                                                <?php else : ?>
                                                    Pilih file
                                                <?php endif; ?>
                                            </label>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan">Catatan Surat</label>
                                        <input type="text" name="catatan" id="input-catatan" class="form-control form-control-user <?= session('errors.catatan') ? 'is-invalid' : '' ?>" value="<?= $surat_masuk['catatan']; ?>"> <?php if (session('errors.catatan')) : ?>
                                            <div id="catatanFeedback" class="invalid-feedback">
                                                <?= session('errors.catatan') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="box-registry select-container">
                                            <label for="pilih_jabatan">Pilih Jabatan Pegawai</label>
                                            <select name="pilih_jabatan" class="form-control form-control-user <?= session('errors.catatan') ? 'is-invalid' : '' ?>" id="input-pilih-jabatan" required>
                                                <?php foreach ($daftar_jabatan as $jabatan) : ?>
                                                    <option value="<?= $jabatan['id_jabatan']; ?>">
                                                        <?= $jabatan['nama_jabatan']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="box-registry select-container">
                                            <label for="pilih_pegawai">Pilih Pegawai</label>
                                            <select name="pilih_pegawai" class="form-control form-control-user <?= session('errors.catatan') ? 'is-invalid' : '' ?>" id="input-pilih-pegawai" required>
                                                <!-- Opsi pegawai akan diisi melalui JavaScript -->
                                            </select>
                                        </div>

                                        <!-- Tambahkan elemen input tersembunyi untuk menyimpan nama jabatan yang terpilih -->
                                        <input type="hidden" name="nama_jabatan" id="input-nama-jabatan" readonly>

                                    </div>
                                    <div class="form-group">
                                        <label for="kepada">Kepada</label>
                                        <input type="text" name="kepada" id="input-kepada" class="form-control form-control-user <?= session('errors.kepada') ? 'is-invalid' : '' ?>" value="<?= $surat_masuk['kepada']; ?>"> <?php if (session('errors.kepada')) : ?>
                                            <div id="kepadaFeedback" class="invalid-feedback">
                                                <?= session('errors.kepada') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_lambat">Tanggal Lambat</label>
                                        <input type="date" name="tgl_lambat" id="input-tgl_lambat" class="form-control form-control-user <?= session('errors.tgl_lambat') ? 'is-invalid' : '' ?>" value="<?= $surat_masuk['tgl_lambat']; ?>"> <?php if (session('errors.tgl_lambat')) : ?>
                                            <div id="tgl_lambatFeedback" class="invalid-feedback">
                                                <?= session('errors.tgl_lambat') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">

                                    </div>
                                    <div class="form-group">

                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <center>
                                            <button type="submit" class="btn btn-user btn-block" style="background-color: darkcyan; color: #fff;"><i class="fas fa-check"></i>&nbsp;&nbsp;Tambah Disposisi</button>

                                        </center>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="container-fluid">

  
    <?php if (session()->getFlashdata('msg')) : ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('msg'); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col">
            <div class="info">
                <center>
                    <h2><i class="fas fa-user-edit"></i>&nbsp;&nbsp;Disposisi</h2>

                </center>
                <hr style="border: 1px grey solid;">
            </div><br>

            <form
                action="<?= base_url('/kepala_bps/save_disposisi/' . $surat_masuk['no_berkas']) ?>"
                method="POST">
                <?= csrf_field(); ?>
                <div class="registry">
                    <div class="avatar">
                        <i class="pencil fas fa-pencil-alt"></i>
                        <i class="book fas fa-book-open"></i>
                    </div>

                    <div class="box-registry">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" id="input-alamat"
                            value="<?= $surat_masuk['alamat']; ?>"
                            readonly>
                    </div>

                    <div class="box-registry">
                        <label for="tgl_surat">Tanggal Surat</label>
                        <input type="date" name="tgl_surat" id="input-tgl_surat"
                            value="<?= $surat_masuk['tgl_surat']; ?>"
                            readonly>
                    </div>

                    <div class="box-registry">
                        <label for="no_surat">Nomor Surat</label>
                        <input type="text" name="no_surat" id="input-no_surat"
                            value="<?= $surat_masuk['no_surat']; ?>"
                            readonly>
                    </div>
                    <div class="box-registry">
                        <label for="perihal">Perihal Surat</label>
                        <input type="text" name="perihal" id="input-perihal"
                            value="<?= $surat_masuk['perihal']; ?>"
                            readonly>
                    </div>
                    <div class="box-registry">
                        <label for="no_petunjuk">Nomor Petunjuk Surat</label>
                        <input type="date" name="no_petunjuk" id="input-no_petunjuk"
                            value="<?= $surat_masuk['no_petunjuk']; ?>"
                            readonly>
                    </div>
                    <div class="box-registry">
                        <label for="scan_surat">Scan Surat</label>
                        <input type="text" name="scan_surat" id="input-scan_surat"
                            value="<?= $surat_masuk['scan_surat']; ?>"
                            readonly>
                    </div>
                    <div class="box-registry">
                        <label for="catatan">Catatan Surat</label>
                        <input type="text" name="catatan" id="input-catatan"
                            value="<?= $surat_masuk['catatan']; ?>"
                            required>
                    </div>

                  
                    <div class="box-registry select-container">
                        <label for="pilih_jabatan">Pilih Jabatan Pegawai</label>
                        <select name="pilih_jabatan" id="input-pilih-jabatan" required>
                            <?php foreach ($daftar_jabatan as $jabatan) : ?>
                            <option
                                value="<?= $jabatan['id_jabatan']; ?>">
                                <?= $jabatan['nama_jabatan']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="box-registry select-container">
                        <label for="pilih_pegawai">Pilih Pegawai</label>
                        <select name="pilih_pegawai" id="input-pilih-pegawai" required>
                     
                        </select>
                    </div>

                  <input type="hidden" name="nama_jabatan" id="input-nama-jabatan" readonly>




                    <div class="box-registry">
                        <label for="kepada">Kepada</label>
                        <input type="text" name="kepada" id="input-kepada"
                            value="<?= $surat_masuk['kepada']; ?>">
                    </div>

                    <div class="box-registry">
                        <label for="tgl_lambat">Tanggal Lambat</label>
                        <input type="date" name="tgl_lambat" id="input-tgl_lambat"
                            value="<?= $surat_masuk['tgl_lambat']; ?>">
                    </div>

                    <div class="button-class">
                        <center>
                            <button type="submit" class="button btn btn-primary">
                                <i class="fas fa-check"></i>&nbsp;&nbsp;Tambah Disposisi
                            </button>
                        </center>

                    </div>
                </div><br>
            </form>

        </div>
    </div>

</div>
-->
<?= $this->endSection(); ?>
<?= $this->section('additional-js'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectJabatan = document.getElementById('input-pilih-jabatan');
        var selectPegawai = document.getElementById('input-pilih-pegawai');
        var inputNamaJabatan = document.getElementById('input-nama-jabatan');


        var daftarPegawai = <?= json_encode($daftar_users); ?>;

        selectJabatan.addEventListener('change', function() {
            updatePegawaiOptions();
        });

        function updatePegawaiOptions() {
            var selectedOption = selectJabatan.options[selectJabatan.selectedIndex];
            var idJabatan = selectedOption.value;
            var namaJabatan = selectedOption.textContent;

            // Set nilai nama jabatan pada elemen input tersembunyi
            inputNamaJabatan.value = namaJabatan;

            // Hapus opsi saat ini
            selectPegawai.innerHTML = '';

            // Tambahkan opsi pegawai yang sesuai dengan jabatan
            daftarPegawai.forEach(function(pegawai) {
                if (pegawai.id_jabatan == idJabatan) {
                    var option = document.createElement('option');
                    option.value = pegawai.id;
                    option.textContent = pegawai.username;
                    selectPegawai.appendChild(option);
                }
            });
        }

        // Panggil fungsi pertama kali halaman dimuat
        updatePegawaiOptions();
    });
</script>


<?= $this->endSection(); ?>