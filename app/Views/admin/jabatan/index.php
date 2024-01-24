<?= $this->extend('admin/templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg">

            <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('msg'); ?>
            </div>
            <?php endif; ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold" style="font-family: Arial;">Daftar Jabatan</h3>
                </div>
                <div class="card-body" style="font-family: Arial;">
                    <div class="mb-2">
                        <a href="/admin/tambah_jabatan" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah
                            Jabatan</a>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jabatan</th>
                                    <th style="width: 20px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($jabatan) { ?>
                                <?php foreach ($jabatan as $num => $data) { ?>
                                <tr>
                                <td><?= $num + 1; ?></td>
                                    <td><?= $data['nama_jabatan']; ?>
                                    </td>

                                    <td style="max-width: 30px; text-align: center;">

                                  
                                        <a href="/admin/delete_jabatan/<?=$data['id_jabatan']?>"
                                            class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>

                                </tr>

                                <!-- Modal -->

                                <!-- End Modal -->

                                <?php } ?>
                                <!-- end foreach -->
                                <?php } else { ?>
                                <tr>
                                    <td colspan="3">
                                        <h3 style="text-align: center;">Data belum ada</h3>
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
<?= $this->section('additional-js'); ?>
<script>
    // Tunggu sampai halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', (event) => {
        // Cari elemen alert
        var alertElement = document.querySelector('.alert');

        // Periksa apakah elemen alert ditemukan
        if (alertElement) {
            // Atur timeout untuk menghapus elemen setelah beberapa detik (misalnya, 5 detik)
            setTimeout(function() {
                alertElement.style.display = 'none'; // Atur gaya elemen untuk menyembunyikannya
            }, 5000); // 5000 milidetik = 5 detik
        }
    });
</script>
<?= $this->endSection(); ?>