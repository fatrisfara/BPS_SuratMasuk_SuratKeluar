<?= $this->extend('admin/templates/index'); ?>


<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-900"> Edit Surat</h1>

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
        <div class="col-12">

            <div class="card shadow">
                <div class="card-header">
                    <a href="/SuratMasuk">&laquo; Kembali ke daftar Surat Masuk</a>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('/SuratMasuk/update/' . $surat_masuk['no_berkas']) ?>" method="post" enctype="multipart/form-data">

                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label for="alamat">Alamat Pengirim</label>
                                    <input name="alamat" type="text" class="form-control form-control-user <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="input-alamat" value="<?= $surat_masuk['alamat']; ?>" />
                                    <div id="alamatFeedback" class="invalid-feedback">
                                        <?= $validation->getError('alamat'); ?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="tgl_surat">Tanggal Surat</label>
                                    <input name="tgl_surat" type="date" class="form-control form-control-user <?= ($validation->hasError('tgl_surat')) ? 'is-invalid' : ''; ?>" id="input-tgl_surat" value="<?= $surat_masuk['tgl_surat']; ?>" />
                                    <div id="tgl_suratFeedback" class="invalid-feedback">
                                        <?= $validation->getError('tgl_surat'); ?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="no_surat">No Surat</label>
                                    <input name="no_surat" type="text" class="form-control form-control-user <?= ($validation->hasError('no_surat')) ? 'is-invalid' : ''; ?>" id="input-no_surat" placeholder="No Surat" value="<?= $surat_masuk['no_surat']; ?>" />
                                    <div id="no_suratFeedback" class="invalid-feedback">
                                        <?= $validation->getError('no_surat'); ?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="perihal_surat">Perihal Surat</label>
                                    <input name="perihal_surat" type="text" class="form-control form-control-user <?= ($validation->hasError('perihal_surat')) ? 'is-invalid' : ''; ?>" id="input-perihal_surat" placeholder="Perihal Surat" value="<?= $surat_masuk['perihal_surat']; ?>" />
                                    <div id="perihal_suratFeedback" class="invalid-feedback">
                                        <?= $validation->getError('perihal_surat'); ?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="no_petunjuk">No Petunjuk Surat</label>
                                    <input name="no_petunjuk" type="date" class="form-control form-control-user <?= ($validation->hasError('no_petunjuk')) ? 'is-invalid' : ''; ?>" id="input-no_petunjuk" placeholder="No Petunjuk" value="<?= $surat_masuk['no_petunjuk']; ?>" />
                                    <div id="no_petunjukFeedback" class="invalid-feedback">
                                        <?= $validation->getError('no_petunjuk'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="scan_surat">Scan Surat</label>
                                    <?php if ($surat_masuk['scan_surat']) : ?>
                                        <p>File yang sudah diunggah: <a href="<?= base_url('uploads/' . $surat_masuk['scan_surat']); ?>" target="_blank"><?= $surat_masuk['scan_surat']; ?></a></p>
                                    <?php else : ?>
                                        <p>Belum ada file yang diunggah</p>
                                    <?php endif; ?>
                                    <input name="scan_surat" type="file" class="form-control form-control-user <?= ($validation->hasError('scan_surat')) ? 'is-invalid' : ''; ?>" id="input-scan_surat" />
                                    <div id="scan_suratFeedback" class="invalid-feedback">
                                        <?= $validation->getError('scan_surat'); ?>
                                    </div>
                                </div>



                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                                <!-- <div class="form-group ">
                                    <label for="tgl_perolehan">Tanggal Perolehan</label>
                                    <input name="tgl_perolehan" type="date" class="form-control form-control-user <?= ($validation->hasError('tgl_perolehan')) ? 'is-invalid' : ''; ?>" id="input-tgl_perolehan" value="" />
                                    <div id="tgl_perolehanFeedback" class="invalid-feedback">
                                        <?= $validation->getError('tgl_perolehan'); ?>
                                    </div>
                                </div> -->
                            </div>
                            <button class="btn btn-block btn-primary" type="submit">Ubah Data</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection(); ?>
<?= $this->section('additional-js'); ?>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $($this).remove();
        })

    }, 3000);
</script>
<?= $this->endSection(); ?>