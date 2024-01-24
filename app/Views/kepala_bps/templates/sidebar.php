<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" style="background: rgb(29, 139, 139); color: white;" id="accordionSidebar">


    <!-- Sidebar - Brand -->
    <style>
        .sidebar-brand-text {
            font-family: Candara, sans-serif;
        font-size: 45px;
    }
    </style>
    </br>
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="<?= base_url('admin'); ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('img/logo_3.png'); ?>" height="80">
        </div>
        <div class="sidebar-brand-text mx-3">BPS</div>
    </a>
</br>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?=base_url('kepala_bps');?>" style="font-family: Arial;">
        <i class="fa fa-home"></i>
            <span style="font-size: 16px;">Beranda</span></a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Kelola Surat
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="<?=base_url('kepala_bps/SuratMasuk');?>" style="font-family: Arial;">
        <i class="fas fa-arrow-circle-down"></i>
            <span style="font-size: 16px;">Disposisi Surat</span></a>
    </li>

</ul>