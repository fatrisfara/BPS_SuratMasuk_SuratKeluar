<?=$this->extend('admin/templates/index');?>

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
                    <h3 class="m-0 font-weight-bold">Daftar Pengajuan Surat </h3>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Nama Pengaju</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Perihal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($pengajuan) {?>
                                    <?php foreach ($pengajuan as $num => $data) {?>
                                        <tr>
                                        <td><?= $num + 1; ?></td>
                                            <td><?=$data['nama_pengaju'];?></td>
                                            <td>
                                        <?php $date = date_create($data['tgl_pengajuan']); ?>
                                        <?= date_format($date, "d-m-Y"); ?>
                                    </td>
                                            <td><?=$data['perihal'];?></td>
                                            <td><?=$data['status_pengajuan'];?></td>
                                            <td align="center"> <a href="/admin/detailajuan/<?=$data['pengajuan_id']?>" 
                                                    class="btn" style="background-color: darkcyan; color: white;"><i
                                                    class="fa fa-eye"></i></a>
                                        </tr>
                                    <?php }?>
                                    <!-- end foreach -->
                                <?php } else {?>
                                    <tr>
                                        <td>
                                            <h3 style="text-align: center;">data belum ada</h3>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?=$this->endSection();?>