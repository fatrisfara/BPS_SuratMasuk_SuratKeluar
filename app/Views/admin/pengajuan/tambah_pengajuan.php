<?= $this->extend('admin/templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->


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
                    <a href="/admin/pengajuan">&laquo; Kembali ke daftar Pengajuan Surat </a>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('/Pengajuan/save_pengajuan') ?> " method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label for="perihal">Perihal</label>
                                    <input name="perihal" type="text" class="form-control form-control-user <?= ($validation->hasError('perihal')) ? 'is-invalid' : ''; ?>" placeholder="Perihal" id="input-perihal" value="<?= old('perihal'); ?>" />
                                    <div id="perihalFeedback" class="invalid-feedback">
                                        <?= $validation->getError('perihal'); ?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="detail_perihal">detail_Perihal</label>
                                    <input name="detail_perihal" type="text" class="form-control form-control-user <?= ($validation->hasError('detail_perihal')) ? 'is-invalid' : ''; ?>" placeholder="detail_Perihal" id="input-detail_perihal" value="<?= old('detail_perihal'); ?>" />
                                    <div id="detail_perihalFeedback" class="invalid-feedback">
                                        <?= $validation->getError('perihal'); ?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="alamat">Alamat Pengajuan Surat</label>
                                    <input name="alamat" type="text" class="form-control form-control-user <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="input-alamat" placeholder="Alamat Pengirim Surat" value="<?= old('alamat'); ?>" />
                                    <div id="alamatFeedback" class="invalid-feedback">
                                        <?= $validation->getError('alamat'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_pengajuan">Tgl Pengajuan Surat</label>
                                    <input name="tgl_pengajuan" type="date" class="form-control form-control-user <?= ($validation->hasError('tgl_pengajuan')) ? 'is-invalid' : ''; ?>" id="input-tgl_pengajuan" placeholder="tgl_pengajuan Pengirim Surat" value="<?= date('Y-m-d'); ?>" readonly />
                                    <div id="tgl_pengajuanFeedback" class="invalid-feedback">
                                        <?= $validation->getError('tgl_pengajuan'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Pengajuan Surat</label>
                                    <div class="form-check">
                                        <input class="form-check-input anonym" type="radio" name="nama_pengaju" id="nama_pengaju1" value="anonym" checked>
                                        <label class="form-check-label" for="nama_pengaju1">
                                            <span class="text-gray-800">Samarkan (anonym)</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="nama_pengaju" id="nama_pengaju2" value="2">
                                        <label class="form-check-label" for="nama_pengaju2">
                                            <span class="text-gray-800">Gunakan nama sendiri</span>
                                        </label>
                                    </div>
                                    <input type="text" class="form-control nama_pengaju" name="nama_pengaju" value="<?= user()->username; ?>" readonly>
                                </div>


                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">


                            </div>
                            <button class="btn btn-block btn-primary">Tambah Data</button>
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
    $('.nama_pengaju').hide();
    $('input[type=radio]').click(function() {
        if ($(this).hasClass('anonym')) {
            $('.nama_pengaju').hide()
        } else {
            $('.nama_pengaju').show()
        }
    })
</script>
<?= $this->endSection(); ?>