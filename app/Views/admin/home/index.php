<?= $this->extend('admin/templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">

 <!-- Total Surat Card -->        

<!-- Surat Keluar Card -->  
<div class="col-xl-3 col-md-6 mb-4">
    <a href="/admin/surat_keluar" style="text-decoration: none; color: inherit;">
        <div class="card  shadow y-900 py-2" style="background-color: darkcyan;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Surat Keluar
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white"><?= $surat_keluar ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-arrow-circle-up fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

 <!-- Surat Masuk Card -->
<div class="col-xl-3 col-md-6 mb-4">
    <a href="/admin/surat_masuk" style="text-decoration: none; color: inherit;">
        <div class="card border-left-darkcyan shadow h-100 py-2" style="background-color: darkcyan;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Surat Masuk
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white"><?= $surat_masuk ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-arrow-circle-down fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

 <!-- Pengajuan Surat Card -->
<div class="col-xl-3 col-md-6 mb-4">
    <a href="/admin/pengajuan" style="text-decoration: none; color: inherit;">
        <div class="card border-left-darkcyan shadow h-100 py-2" style="background-color: darkcyan;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Pengajuan Surat
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white"><?= $pengajuan ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-envelope-open fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="col-xl-3 col-md-6 mb-4">
    <a href="/" style="text-decoration: none; color: inherit;">
        <div class="card border-left-darkcyan shadow h-100 py-2" style="background-color: darkcyan;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Kalender
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white"> <?= $tanggalEcho = format_tanggal(date('Y-m-d'));?></div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
</div>
</div>


<?php
date_default_timezone_set("Asia/Jakarta");
$tanggalEcho = format_tanggal(date('Y-m-d'));

function format_tanggal($tanggal)
{
    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    );
    $pecahkan = explode('-', $tanggal);

    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}
?>
<?= $this->endSection(); ?>