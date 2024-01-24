<?= $this->extend('admin/templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Data Surat Keluar</h1>

    <?php if (session()->has('pesanBerhasil')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session('pesanBerhasil') ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <div class="card-header">
                    <a href="/admin/surat_keluar" class="btn ml-n3 text-primary font-weight-bold"><i class="fas fa-chevron-left"></i> Kembali ke daftar surat keluar</a>
                </div>
                <div class="card-body">
                    <div class="row  ">
                        <div class="col-md-3">Nomor Berkas</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= $surat->no_berkas ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row  ">
                        <div class="col-md-3">Alamat Penerima</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= $surat->alamat ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Tanggal Surat</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= date_format(date_create($surat->tgl_surat), "d-m-Y"); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Perihal Surat</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= $surat->perihal ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Nomor Petunjuk</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= date_format(date_create($surat->no_petunjuk), "d-m-Y"); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">Nomor Surat</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= $surat->no_surat; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Scan Surat</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <a href="<?= site_url("admin/pdf/{$surat->scan_surat}") ?>" target="_blank">
                                <button>Lihat PDF</button>
                            </a>
                            <!-- <?= $surat->scan_surat; ?> -->


                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection('page-content'); ?>