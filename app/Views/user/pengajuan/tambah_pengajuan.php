<?= $this->extend('user/templates/index'); ?>

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
                                    <h1 class="h4 text-gray-900 mb-5">Tambah Pengajuan</h1>
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
                                <form action="<?= base_url('/user/save_pengajuan') ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea type="text" cols="5" rows="2" name="alamat" id="input-alamat" class="form-control form-control-user <?= session('errors.alamat') ? 'is-invalid' : '' ?>" value="<?= old('alamat'); ?>" autofocus>
                                    </textarea>
                                        <?php if (session('errors.alamat')) : ?>
                                            <div id="alamatFeedback" class="invalid-feedback">
                                                <?= session('errors.alamat') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                  
                                    <div class="form-group">
                                        <label for="tgl_surat">tanggal surat</label>
                                        <input type="date" name="tgl_surat" id="input-tgl_surat" class="form-control form-control-user <?= session('errors.tgl_surat') ? 'is-invalid' : '' ?>" value="<?= old('tgl_surat'); ?>" autofocus>
                                        <?php if (session('errors.tgl_surat')) : ?>
                                            <div id="tgl_suratFeedback" class="invalid-feedback">
                                                <?= session('errors.tgl_surat') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="perihal">Perihal Surat</label>
                                        <input type="text" name="perihal" class="form-control form-control-user <?= session('errors.tgl_surat') ? 'is-invalid' : '' ?>" value="<?= old('tgl_surat'); ?>" id="input-perihal" value="<?= old('perihal'); ?>">
                                        <?php if ($validation->getError('perihal')) : ?>
                                            <div id="perihalFeedback" class="invalid-feedback">
                                                <?= $validation->getError('perihal'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="detail_perihal">Detail Perihal</label>
                                        <textarea name="detail_perihal"cols="5" rows="2" id="input-detail_perihal" class="form-control form-control-user <?= session('errors.tgl_surat') ? 'is-invalid' : '' ?>"><?= old('detail_perihal'); ?></textarea>
                                        <?php if ($validation->getError('detail_perihal')) : ?>
                                            <div id="detail_perihalFeedback" class="invalid-feedback">
                                                <?= $validation->getError('detail_perihal'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">

                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <center>
                                            <button type="submit" class="btn btn-user btn-block" style="background-color: darkcyan; color: #fff;">Simpan</button>

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