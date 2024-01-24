<?=$this->extend('/admin/templates/index');?>

<?=$this->section('page-content');?>
<style>
    .rounded-left {
        border-top-left-radius: 1.25rem;
        border-bottom-left-radius: 1.25rem;
    }

    .rounded-right {
        border-top-right-radius: 1.25rem;
        border-bottom-right-radius: 1.25rem;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Edit Data Surat Masuk</h1>
                                </div>
                      
                                <form action="<?= base_url('/admin/update_masuk/' . $surat_masuk['no_berkas']) ?>" method="post" enctype="multipart/form-data" class="rounded">
    <?= csrf_field() ?>
    <div class="form-group">
        <label for="alamat">Alamat Pengirim</label>
        <input type="text" class="form-control form-control-user <?= session('errors.alamat') ? 'is-invalid' : '' ?>" name="alamat" value="<?= old('alamat', $surat_masuk['alamat']) ?>" autofocus>
        <?php if (session('errors.alamat')) : ?>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="tgl_surat">Tanggal Surat</label>
        <input type="date" class="form-control form-control-user <?= session('errors.tgl_surat') ? 'is-invalid' : '' ?>" name="tgl_surat" value="<?= old('tgl_surat', $surat_masuk['tgl_surat']) ?>">
        <?php if (session('errors.tgl_surat')) : ?>
            <div class="invalid-feedback"><?= session('errors.tgl_surat') ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="no_surat">Nomor Surat</label>
        <input type="text" class="form-control form-control-user <?= session('errors.no_surat') ? 'is-invalid' : '' ?>" name="no_surat" value="<?= old('no_surat', $surat_masuk['no_surat']) ?>" />
        <?php if (session('errors.no_surat')) : ?>
            <div class="invalid-feedback"><?= session('errors.no_surat') ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="perihal">Perihal Surat</label>
        <input type="text" class="form-control form-control-user <?= session('errors.perihal') ? 'is-invalid' : '' ?>" name="perihal" value="<?= old('perihal', $surat_masuk['perihal']) ?>">
        <?php if (session('errors.perihal')) : ?>
            <div class="invalid-feedback"><?= session('errors.perihal') ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group">
                                        <label for="scan_surat">Scan Surat</label>
                                        <?php if (!empty($surat_masuk['scan_surat'])) : ?>
                                            <p>File Saat Ini: <?= $surat_masuk['scan_surat'] ?></p>
                                        <?php endif; ?>
                                        <input type="file" class="form-control-file <?= session('errors.scan_surat') ? 'is-invalid' : '' ?>" name="scan_surat">
                                        <?php if (session('errors.scan_surat')) : ?>
                                            <div class="invalid-feedback"><?= session('errors.scan_surat') ?></div>
                                        <?php endif; ?>
                                        </br>
                                    </div>  
    <button type="submit" class="btn btn-user btn-block" style="background-color: darkcyan; color: #fff;">Edit Data</button>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection();?>
