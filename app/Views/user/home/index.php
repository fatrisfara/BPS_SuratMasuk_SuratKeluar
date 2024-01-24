<?=$this->extend('user/templates/index');?>

<?=$this->section('page-content');?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">

        <!-- Total Surat Card -->


        <!-- Total Surat Di-Proses Card -->
       <div class="col-xl-3 col-md-6 mb-4">
    <a href="/user/pengajuan" style="text-decoration: none; color: inherit;">
        <div class="card  shadow y-900 py-2" style="background-color: darkcyan;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Total Pengajuan Surat
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-white"><?= $pengajuan ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-arrow-circle-up fa-2x text-white"></i>
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

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}
?>
<?=$this->endSection();?>
