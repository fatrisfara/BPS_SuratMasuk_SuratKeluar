<?=$this->extend('user/templates/index');?>

<?=$this->section('page-content');?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg">

            <?php if (session()->getFlashdata('pesanBerhasil')): ?>
                <div class="alert alert-success" role="alert">
                    <?=session()->getFlashdata('pesanBerhasil');?>
                </div>
            <?php endif;?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold">Data Pengajuan Surat</h3>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <a href="/user/form" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah Pengajuan</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id Pengajuan</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Perihal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($pengajuan): ?>
                                    <?php foreach ($pengajuan as $num => $data): ?>
                                        <tr>
                                            <td><?=$data['pengajuan_id'];?></td>
                                            <td>
                                        <?php $date = date_create($data['tgl_pengajuan']); ?>
                                        <?= date_format($date, "d-m-Y"); ?>
                                    </td>
                                            <td><?=$data['perihal'];?></td>
                                            <td><?=$data['status_pengajuan'];?></td>
                                            <td>

                                                <!-- Tombol "Detail" untuk melihat informasi detail pengguna -->
<a href="/user/detailajuan/<?=$data['pengajuan_id']?>"  class="btn" style="background-color: darkcyan; color: white;"><i
                                                class="fa fa-eye"></i></a>

<?php
// Cek status pengguna, jika "belum diproses"
if ($data['status_pengajuan'] == 'belum diproses') {
    // Jika belum diproses, tampilkan tombol "Edit" yang mengarahkan ke halaman pengeditan
    ?>
    <a href="/user/editPengajuan/<?=$data['pengajuan_id']?>" class="btn btn-success"><i class="fa fa-pen"></i> </a>
<?php } else {
    // Jika sudah diproses, tampilkan tombol "Edit" non-interaktif atau berwarna abu-abu
    ?>
    <button class="btn btn-secondary" disabled><i class="fa fa-pen"></i> </button>
<?php }?>
                                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?=$data['pengajuan_id']?>"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>

                                        <!-- Modal for each data -->
                                        <div class="modal fade" id="deleteModal<?=$data['pengajuan_id']?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Data</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus data ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="/user/hapus/<?=$data['pengajuan_id']?>" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach;?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5">
                                            <h3 style="text-align: center;">Data belum ada</h3>
                                        </td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
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
