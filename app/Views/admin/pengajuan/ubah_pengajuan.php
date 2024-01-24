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
                    <a href="/admin/pengajuan">&laquo; Kembali ke daftar pengajuan Surat </a>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('/user/update/' . $pengajuan['id_pengajuan']) ?>" method="post" enctype="multipart/form-data">

                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label for="alamat">Alamat </label>
                                    <input name="alamat" type="text" class="form-control form-control-user <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="input-alamat" value="<?= $pengajuan['alamat']; ?>" />
                                    <div id="alamatFeedback" class="invalid-feedback">
                                        <?= $validation->getError('alamat'); ?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                                    <input name="tgl_pengajuan" type="date" class="form-control form-control-user <?= ($validation->hasError('tgl_pengajuan')) ? 'is-invalid' : ''; ?>" id="input-tgl_pengajuan" value="<?= $pengajuan['tgl_pengajuan']; ?>" readonly />
                                    <div id="tgl_pengajuanFeedback" class="invalid-feedback">
                                        <?= $validation->getError('tgl_pengajuan'); ?>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="perihal">Perihal Surat</label>
                                    <input name="perihal" type="text" class="form-control form-control-user <?= ($validation->hasError('perihal')) ? 'is-invalid' : ''; ?>" id="input-perihal" value="<?= $pengajuan['perihal']; ?>" />
                                    <div id="perihalFeedback" class="invalid-feedback">
                                        <?= $validation->getError('perihal'); ?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="detail_perihal">Detail Perihal</label>
                                    <input name="detail_perihal" type="text" class="form-control form-control-user <?= ($validation->hasError('detail_perihal')) ? 'is-invalid' : ''; ?>" id="input-detail_perihal" value="<?= $pengajuan['detail_perihal']; ?>" />
                                    <div id="detail_perihalFeedback" class="invalid-feedback">
                                        <?= $validation->getError('detail_perihal'); ?>
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