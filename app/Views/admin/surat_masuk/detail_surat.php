<?= $this->extend('admin/templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Data Surat Masuk</h1>

    <?php if (session()->has('pesanBerhasil')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session('pesanBerhasil') ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <div class="card-header">
                    <a href="/admin/surat_masuk" class="btn ml-n3 text-primary font-weight-bold"><i class="fas fa-chevron-left"></i> Kembali ke daftar surat masuk</a>
                    <a href="<?php echo base_url('admin/ekspor/' . $surat->no_berkas); ?>" class="text-light btn btn-success font-weight-bold float-right"><i class="fa fa-print"></i>
                        Cetak disposisi</a>
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
                        <div class="col-md-3">Alamat Pengirim</div>
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
                    <div class="row">
                        <div class="col-md-3">Nomor Surat</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= $surat->no_surat; ?>
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
                        <div class="col-md-3">Scan Surat</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <a href="<?= site_url("admin/pdf/{$surat->scan_surat}") ?>" target="_blank">
                                <button>Lihat PDF</button>
                            </a>



                            </a>
                            <br>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Catatan</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= $surat->catatan ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Pilih Jabatan Pegawai</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= $surat->nama_jabatan ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Pilih Pegawai</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= $surat->username ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Kepada</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= $surat->kepada ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Tanggal Lambat</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= (empty($surat->tgl_lambat) ? '' : implode('-', array_reverse(explode('-', $surat->tgl_lambat)))); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printScan(url) {
            var printWindow = window.open(url, '_blank');
            printWindow.print();
        }
    </script>
</div>
<?= $this->endSection('page-content'); ?>