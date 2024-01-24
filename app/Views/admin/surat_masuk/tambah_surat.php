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
                                    <h1 class="h4 text-gray-900 mb-4">Tambah Data Surat Masuk</h1>
                                </div>
                      
                                <form action="<?=base_url('/admin/save_masuk/')?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label for="alamat">Alamat Pengirim</label>
                                        <input type="text" class="form-control form-control-user <?= session('errors.alamat') ? 'is-invalid' : '' ?>" name="alamat" value="<?= old('alamat') ?>" autofocus>
                                        
                                        <?php if (session('errors.alamat')) : ?>
                                            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_surat">Tanggal Surat</label>
                                        <input type="date" class="form-control form-control-user <?= session('errors.tgl_surat') ? 'is-invalid' : '' ?>" name="tgl_surat" value="<?= old('tgl_surat') ?>" autofocus>
                                        <?php if (session('errors.tgl_surat')) : ?>
                                            <div class="invalid-feedback"><?= session('errors.tgl_surat') ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_surat">Nomor Surat</label>
                                        <input type="text" class="form-control form-control-user <?= session('errors.no_surat') ? 'is-invalid' : '' ?>" name="no_surat" value="<?= old('no_surat') ?>" autofocus>
                                        <?php if (session('errors.no_surat')) : ?>
                                            <div class="invalid-feedback"><?= session('errors.no_surat') ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="perihal">Perihal Surat</label>
                                        <input type="text" class="form-control form-control-user <?= session('errors.perihal') ? 'is-invalid' : '' ?>" name="perihal" value="<?= old('perihal') ?>" autofocus>
                                        <?php if (session('errors.perihal')) : ?>
                                            <div class="invalid-feedback"><?= session('errors.perihal') ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="scan_surat">Scan Surat</label>
                                        <input type="file" class="form-control <?= session('errors.scan_surat') ? 'is-invalid' : '' ?>" name="scan_surat" autofocus>
                                        <?php if (session('errors.scan_surat')) : ?>
                                            <div class="invalid-feedback"><?= session('errors.scan_surat') ?></div>
                                        <?php endif; ?>
                                    </div>
                                    </br>
                                    <button type="submit" class="btn btn-user btn-block" style="background-color: darkcyan; color: #fff;">Tambah Data</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Function to display an alert if the Alamat field is empty
    function showAlert() {
        var alamatValue = document.getElementsByName('alamat')[0].value.trim();
        var tglSuratValue = document.getElementsByName('tgl_surat')[0].value.trim();
        var noSuratValue = document.getElementsByName('no_surat')[0].value.trim();
        var perihalSuratValue = document.getElementsByName('perihal')[0].value.trim();
        var scanSuratValue = document.getElementsByName('scan_surat')[0].value.trim();

        if (alamatValue === '') {
            alert('Alamat wajib diisi!');
            event.preventDefault(); // Prevent form submission
        }

        if (tglSuratValue === '') {
            alert('Tanggal surat wajib diisi!');
            event.preventDefault(); // Prevent form submission
        }
        if (noSuratValue === '') {
            alert('Nomor surat wajib diisi!');
            event.preventDefault(); // Prevent form submission
        }if (perihalSuratValue === '') {
            alert('Perihal surat wajib diisi!');
            event.preventDefault(); // Prevent form submission
        }if (scanSuratValue === '') {
            alert('Scan surat wajib diupload!');
            event.preventDefault(); // Prevent form submission
        }
    }

    // Attach the showAlert function to the form submission event
    document.querySelector('form').addEventListener('submit', function (event) {
        showAlert(); // Check on form submission
        // You can also use event.preventDefault(); here if you want to prevent the form submission in case of an empty field.
    });
</script>
<?=$this->endSection();?>
