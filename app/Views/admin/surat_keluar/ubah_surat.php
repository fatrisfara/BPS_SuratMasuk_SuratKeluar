<?=$this->extend('admin/templates/index');?>

<?=$this->section('page-content');?>
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
                                    <h1 class="h4 text-gray-900 mb-4">Edit Data Surat Keluar</h1>
                                </div>
                                <?php if (session()->getFlashdata('msg')): ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-success" role="alert">
                                                <?=session()->getFlashdata('msg');?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <form action="<?=base_url('/admin/update_keluar/' . $surat_keluar['no_berkas'])?>" method="post" enctype="multipart/form-data">
                                    <?=csrf_field();?>
                                    <div class="form-group">
                                        <label for="alamat">Alamat Penerima</label>
                                        <input type="text" name="alamat" id="input-alamat" class="form-control form-control-user <?= session('errors.alamat') ? 'is-invalid' : '' ?>" value="<?= old('alamat', $surat_keluar['alamat']) ?>" autofocus>
                                        <?php if (session('errors.alamat')): ?>
                                            <div id="alamatFeedback" class="invalid-feedback">
                                                <?= session('errors.alamat') ?>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_surat">Tanggal Surat</label>
                                        <input type="date" name="tgl_surat" id="input-tgl_surat" class="form-control form-control-user <?= session('errors.tgl_surat') ? 'is-invalid' : '' ?>" value="<?= old('tgl_surat', $surat_keluar['tgl_surat']) ?>">
                                        <?php if (session('errors.tgl_surat')): ?>
                                            <div id="tgl_suratFeedback" class="invalid-feedback">
                                                <?= session('errors.tgl_surat') ?>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                    <div class="form-group">
                                        <label for="perihal">Perihal Surat</label>
                                        <input type="text" name="perihal" id="input-perihal" class="form-control form-control-user <?= session('errors.perihal') ? 'is-invalid' : '' ?>" value="<?= old('perihal', $surat_keluar['perihal']) ?>">
                                        <?php if (session('errors.perihal')): ?>
                                            <div id="perihalFeedback" class="invalid-feedback">
                                                <?= session('errors.perihal') ?>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_surat">Nomor Surat</label>
                                        <input type="text" name="no_surat" id="input-no_surat" class="form-control form-control-user <?= session('errors.no_surat') ? 'is-invalid' : '' ?>" value="<?= old('no_surat', $surat_keluar['no_surat']) ?>">
                                        <?php if (session('errors.no_surat')): ?>
                                            <div id="no_suratFeedback" class="invalid-feedback">
                                                <?= session('errors.no_surat') ?>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                    <div class="form-group">
                                        <label for="scan_surat">Scan Surat</label>
                                        <?php if ($surat_keluar['scan_surat']): ?>
                                            <p>File sudah diupload: <?= $surat_keluar['scan_surat'] ?></p>
                                            <input type="file" name="scan_surat" id="input-scan_surat" class="form-control-file <?= session('errors.scan_surat') ? 'is-invalid' : '' ?>">
                                        <?php else: ?>
                                            <input type="file" name="scan_surat" id="input-scan_surat" class="form-control <?= session('errors.scan_surat') ? 'is-invalid' : '' ?>">
                                            <?php if (session('errors.scan_surat')): ?>
                                                <div id="scan_suratFeedback" class="invalid-feedback">
                                                    <?= session('errors.scan_surat') ?>
                                                </div>
                                            <?php endif;?>
                                        <?php endif; ?>
                                    </div>
                                            </br>
                                        <button type="submit" class="btn btn-user btn-block" 
                                        style="background-color: darkcyan; color: #fff;">Edit Data</button>
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
<?=$this->section('additional-js');?>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $($this).remove();
        })

    }, 3000);
</script>
<?=$this->endSection();?>
