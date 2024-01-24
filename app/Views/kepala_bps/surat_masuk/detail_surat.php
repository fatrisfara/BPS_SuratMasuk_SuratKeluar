<?=$this->extend('kepala_bps/templates/index');?>

<?=$this->section('page-content');?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Pengajuan Surat</h1>




    <?php if (session()->has('pesanBerhasil')): ?>
    <div class="alert alert-success" role="alert">
        <?=session('pesanBerhasil')?>
    </div>
    <?php endif;?>

    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <div class="card-header">
                    <a href="/kepala_bps/SuratMasuk" class="btn ml-n3 text-primary font-weight-bold"><i
                            class="fas fa-chevron-left"></i> Kembali ke daftar surat masuk</a>


                </div>
                <div class="card-body">
                    <div class="row  ">
                        <div class="col-md-3">Alamat Pengirim</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$surat->alamat?>

                        </div>

                    </div>
                    <hr>


                    <div class="row ">
                        <div class="col-md-3">Tanggal Surat</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$surat->tgl_surat?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">No Surat</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$surat->no_surat;?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Perihal Surat</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$surat->perihal?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3"> No Petunjuk Surat</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$surat->no_petunjuk?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3"> Scan Surat</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$surat->scan_surat?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3"> Catatan Surat</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$surat->catatan?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Pilih Bagian</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$surat->nama_jabatan?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3"> Pilih Pegawai Pegawai</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$surat->username?>
                        </div>
                    </div>
                    <hr>

                    <div class="row ">
                        <div class="col-md-3"> Kepada</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$surat->kepada?>
                        </div>
                    </div>
                    <hr>



                </div>
            </div>
        </div>
    </div>

</div>
<?=$this->endSection('page-content');?>