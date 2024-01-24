<?=$this->extend('admin/templates/index');?>

<?=$this->section('page-content');?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg">
            <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-success" role="alert">
                <?=session()->getFlashdata('msg');?>
            </div>
            <?php endif;?>
            <div class="card shadow mb-4" style="font-family: Arial;">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold">Daftar Surat Masuk</h3>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <a href="/admin/form_masuk" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah
                            Surat</a>
                        <a href="<?php echo base_url('admin/laporan_SMasuk'); ?>"
                            class="btn btn-success"><i class="fas fa-print"></i> Laporan</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nomor Berkas</th>
                                    <th>Nomor Petunjuk</th>
                                    <th>Alamat Pengirim</th>
                                    <th>Perihal Surat</th>
                                    <th>Pegawai Ditugaskan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($masuk) {?>
                                <?php foreach ($masuk as $num => $data) {?>
                                <tr>
                                    <td><?=$data['no_berkas'];?>
                                    </td>
                                    <td>
                                        <?php $date = date_create($data['no_petunjuk']); ?>
                                        <?= date_format($date, "d-m-Y"); ?>
                                    </td>
                                    <td><?=$data['alamat'];?>
                                    </td>
                                    <td><?=$data['perihal'];?>
                                    </td>
                                    <td><?=$data['username'];?>
                                    </td> <!-- Tambahkan kolom username -->
                                    <td>
                                        <?php if ($data['status_awal'] == 'Sudah Disposisi'): ?>
                                        <span><?=$data['status_awal'];?></span>
                                        <?php else: ?>
                                        <span style="cursor: pointer;"
                                            data-no_berkas="<?=$data['no_berkas'];?>"><?=$data['status_awal'];?></span>
                                        <?php endif;?>
                                    </td>
                                    <td>
                                        <a href="/admin/detail_masuk/<?=$data['no_berkas']?>"
                                            class="btn" style="background-color: darkcyan; color: white;"><i
                                                class="fa fa-eye"></i></a>
                                                <?php if ($data['status_awal'] == 'Belum Disposisi') { ?>
   
    <a href="/admin/edit_masuk/<?=$data['no_berkas']?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
<?php } else { ?>
    <button class="btn btn-secondary"><i class="fa fa-edit"></i></button>
  
    <!-- You can choose to include or exclude the edit_masuk button here based on your requirements -->
<?php } ?>

                                        <!-- <a href="/admin/edit_masuk/<?=$data['no_berkas']?>"
                                            class="btn btn-warning"><i class="fas fa-edit"></i></a> -->
                                        <a href="/admin/delete_masuk/<?=$data['no_berkas']?>"
                                            class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php }?>
                                <?php } else {?>
                                <tr>
                                    <td colspan="7">
                                        <h3 style="text-align: center;">Data belum ada</h3>
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
<?=$this->section('additional-js');?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php foreach ($masuk as $num => $data) {?>
        getUsernameById
            ( <?=$data['id'];?> , <?=$num;?> );
        <?php }?>
    });

    //memanggil fungsi untuk mendapatkan username
    function getUsernameById(userId, rowNumber) {
        fetch('/admin/getUsernameById/' + userId)
            .then(response => response.json())
            .then(data => {
                document.getElementById('username-' + rowNumber).innerText = data.username;
            })
            .catch(error => console.error('Error:', error));
    }

    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        })
    }, 15000);
</script>
<?=$this->endSection();?>