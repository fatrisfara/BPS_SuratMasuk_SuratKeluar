<?=$this->extend('kepala_bps/templates/index');?>

<?=$this->section('page-content');?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">

        <!-- Total Surat Card -->




        <!-- Belum Disposisi Card -->
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card  shadow y-900 py-2" style="background-color: darkcyan;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Belum Disposisi</div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?=$belum_diposisi_surat?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sudah Disposisi Card -->
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card  shadow y-900 py-2" style="background-color: darkcyan;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Sudah Disposisi</div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?=$sudah_disposisi_surat?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>



           <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card  shadow y-900 py-2" style="background-color: darkcyan;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-white"> <?=$tanggalEcho = format_tanggal(date('Y-m-d'));
?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
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
