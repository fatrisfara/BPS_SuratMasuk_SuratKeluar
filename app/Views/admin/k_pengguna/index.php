<?=$this->extend('admin/templates/index')?>

<?=$this->section('page-content')?>

<?=view('Myth\Auth\Views\_message_block')?>

<section class="content">
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
                    <h3 class="m-0 font-weight-bold">Daftar Pengguna</h3>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <a href="/admin/tambah_user" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah
                            Pengguna</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
foreach ($users as $rw) {
    $kelola = "kelola" . $rw->id;
    echo $$kelola;
}
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    // Ambil elemen-elemen yang dibutuhkan di dalam modal
    const passwordInputModal = document.getElementById('password');
    const showPasswordInModalBtn = document.getElementById('showPasswordInModal');

    // Tambahkan event listener pada tombol "Show Password" di dalam modal
    showPasswordInModalBtn.addEventListener('click', function() {
        // Ubah tipe input di dalam modal menjadi 'text' atau 'password'
        const currentTypeModal = passwordInputModal.type;
        passwordInputModal.type = currentTypeModal === 'password' ? 'text' : 'password';
    });
</script>
<?=$this->endSection()?>