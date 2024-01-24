<?= $this->extend('admin/templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg">

            <?php if (session()->getFlashdata('pesanBerhasil')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesanBerhasil'); ?>
                </div>
            <?php endif; ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold">Daftar Surat Keluar</h3>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <a href="/Admin/form_keluar" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah Surat</a>
                        <a href="<?php echo base_url('admin/laporan_SKeluar'); ?>" class="btn btn-success"><i class="fas fa-print"></i> Laporan</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nomor Berkas</th>
                                    <th>Nomor Petunjuk</th>
                                    <th>Alamat Penerima</th>
                                    <th>Perihal Surat</th>                                   
                                    <th>Nomor Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($keluar) { ?>
                                    <?php foreach ($keluar as $num => $data) { ?>
                                        <tr>
                                            <td><?= $data['no_berkas']; ?></td>
                                            <td>
                                                <?php $date = date_create($data['no_petunjuk']); ?>
                                                 <?= date_format($date, "d-m-Y"); ?>
                                            </td>
                                            <td><?= $data['alamat']; ?></td>
                                            <td><?= $data['perihal']; ?></td>
                                            <td><?= $data['no_surat']; ?></td>
                                            <td>
                                                <?php $date = date_create($data['tgl_surat']); ?>
                                                <?= date_format($date, "d-m-Y"); ?>
                                            </td>
                                        
                                            <td>
                                                <a href="/admin/detailSK/<?= $data['no_berkas'] ?>" class="btn" style="background-color: darkcyan; color: white;"><i class="fa fa-eye"></i> </a>
                                                <a href="/admin/edit_keluar/<?= $data['no_berkas'] ?>" class="  btn btn-warning"><i class="fas fa-edit"></i> </a>
                                                <a href="/admin/deleteSK/<?= $data['no_berkas'] ?>" class="  btn btn-danger"><i class="fas fa-trash"></i> </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <!-- end foreach -->
                                <?php } else { ?>
                                    <tr>
                                        <td>
                                            <h3>data belum ada</h3>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>