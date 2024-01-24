<?=$this->extend('admin/templates/index');?>

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
                    <a href="/admin/pengajuan" class="btn ml-n3 text-primary font-weight-bold"><i class="fas fa-chevron-left"></i> Kembali ke daftar pengajuan surat</a>

                    <?php if ($detail->status_pengajuan == 'belum diproses') {?>

                        <a href="/admin/prosesPengajuan/<?=$detail->pengajuan_id?>" class="text-light btn btn-warning font-weight-bold float-right"><i class="fa fa-clipboard"></i> Proses Pengajuan</a>
                    <?php } elseif ($detail->status_pengajuan == 'diproses') {?>
                        <div class="btn-group float-right">
                            <a class="btn btn-success" href="#" data-toggle="modal" data-target="#modalPengaduan">
                                Selesaikan Pengajuan
                            </a>
                        </div>

                    <?php }
;?>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-3">Nama Pengaju</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$detail->nama_pengaju?>
                        </div>
                    </div>
                    <hr>
                    <div class="row  ">
                        <div class="col-md-3">Status Pengajuan</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$detail->status_pengajuan?>

                        </div>

                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Tanggal Pengajuan</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?= date_format(date_create($detail->tgl_pengajuan), "d-m-Y"); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Alamat Penerima</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$detail->alamat?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Perihal</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$detail->perihal?>
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">Detail Perihal</div>
                        <div class="col-md-1 d-none d-md-block">:</div>
                        <div class="col-md-8">
                            <?=$detail->detail_perihal?>
                        </div>
                    </div>
                    <hr>


                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalPengaduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Status Pengajuan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan "Selesai" jika akan mengubah status pengajuan menjadi selesai</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-success" href="/admin/terimaPengajuan/<?=$detail->pengajuan_id?>">Selesai</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection('page-content');?>