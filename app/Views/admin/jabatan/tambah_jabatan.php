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
                                    <h1 class="h4 text-gray-900 mb-5">Tambah Jabatan</h1>
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
                                <form action="<?=base_url('/admin/save_jabatan')?>" method="post" enctype="multipart/form-data">
                                    <?=csrf_field();?>
                                    <div class="form-group">
                                        <label for="nama_jabatan">Nama Jabatan</label>
                                        <input type="text" name="nama_jabatan" id="input-nama_jabatan" class="form-control form-control-user <?= session('errors.nama_jabatan') ? 'is-invalid' : '' ?>" value="<?=old('nama_jabatan');?>" autofocus>
                                        <?php if (session('errors.nama_jabatan')): ?>
                                            <div id="nama_jabatanFeedback" class="invalid-feedback">
                                                <?= session('errors.nama_jabatan') ?>
                                            </div>
                                        <?php endif;?>
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
