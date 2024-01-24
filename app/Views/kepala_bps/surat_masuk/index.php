<?=$this->extend('kepala_bps/templates/index');?>

<?=$this->section('page-content');?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg">

            <?php if (session()->getFlashdata('pesanBerhasil')): ?>
                <div class="alert alert-success" role="alert">
                    <?=session()->getFlashdata('pesanBerhasil');?>
                </div>
            <?php endif;?>
            <div class="card shadow mb-4" style="font-family: Arial;">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold">Daftar Disposisi Surat Masuk</h3>
                </div>
                <div class="card-body">
                    <div class="mb-2">

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
                                            <td><?=$data['no_berkas'];?></td>
                                            <td>
                                        <?php $date = date_create($data['no_petunjuk']); ?>
                                        <?= date_format($date, "d-m-Y"); ?>
                                    </td>
                                            <td><?=$data['alamat'];?></td>
                                            <td><?=$data['perihal'];?></td>
                                            <td><?=$data['username'];?></td>
                                            <td>
                                                <?php if ($data['status_awal'] == 'Sudah Disposisi'): ?>
                                                    <!-- Teks akan muncul jika status_awal adalah 'Sudah Disposisi', tombol tidak bisa diklik -->
                                                    <span class="text"><?=$data['status_awal'];?></span>
                                                <?php else: ?>
                                                    <!-- Tombol delete akan muncul jika status_awal adalah 'Belum Disposisi' -->
                                                    <a href="/kepala_bps/tambah_disposisi/<?=$data['no_berkas'];?>" class="btn btn-danger text-white btnTambahDisposisi" data-no_berkas="<?=$data['no_berkas'];?>">
                                                        <?=$data['status_awal'];?>
                                                    </a>
                                                   
                                              
                                            
                                                <?php endif;?>

                                            </td>
                                            <td>
                                                <a href="/kepala_bps/detailSM/<?=$data['no_berkas']?>" class="btn" style="background-color: darkcyan; color: white;"><i
                                                class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php }?>
                                <?php } else {?>
                                    <tr>
                                        <td>
                                            <h3 style=" text-align: center;">data belum ada</h3>
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
            $($this).remove();
        })
    }, 3000);
<?=$this->endSection();?>