<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
    style="background: rgb(29, 139, 139); color: white;" id="accordionSidebar">

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
        <a class="nav-link"
            href="<?= base_url('admin'); ?>"
            style="font-family: Arial;">
            <i class="fa fa-home"></i>
            <span style="font-size: 16px;">Beranda</span></a>
    </li>

    <!-- Divider -->
    <?php if (in_groups('admin')) : ?>
    <hr class="sidebar-divider">

    <!-- Heading -->

    <div class="sidebar-heading">
        Master user
    </div>

    <!-- Nav Item - Pages Collapse Menu -->

    <li class="nav-item">
        <a class="nav-link"
            href="<?= base_url('admin/kelola_pengguna'); ?>"
            style="font-family: Arial;">
            <i class="fa fa-users"></i>
            <span style="font-size: 16px;">Kelola Pengguna</span></a>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link"
            href="<?= base_url('admin/jabatan'); ?>"
            style="font-family: Arial;">
            <i class="fa fa-list-alt"></i>
            <span style="font-size: 16px;">Kelola Jabatan</span></a>
    </li>
    <?php endif; ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Kelola Surat
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link"
            href="<?= base_url('admin/surat_masuk'); ?>"
            style="font-family: Arial;">
            <i class="fas fa-arrow-circle-down"></i>
            <span style="font-size: 16px;">Surat Masuk</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link"
            href="<?= base_url('admin/pengajuan'); ?>"
            style="font-family: Arial;">
            <i class="fa fa-envelope-open"></i>
            <span style="font-size: 16px;">Pengajuan Surat</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link"
            href="<?= base_url('admin/surat_keluar'); ?>"
            style="font-family: Arial;">
            <i class="fas fa-arrow-circle-up"></i>
            <span style="font-size: 16px;">Surat Keluar</span></a>
    </li>

</ul>