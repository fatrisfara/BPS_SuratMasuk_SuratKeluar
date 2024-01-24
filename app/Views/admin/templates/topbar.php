<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<div class="text-left">
    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
</div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= user()->username; ?></span>
                <img class="img-profile rounded-circle" src="<?= empty(user()->foto) ? '/img/default.jpg' : '/uploads/profile/' . user()->foto; ?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url('admin/profil'); ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Add this script to handle push menu toggle -->
<script>
    $(document).ready(function () {
        // Handle push menu toggle
        $('.nav-link[data-widget="pushmenu"]').on('click', function () {
            $('body').toggleClass('sidebar-toggled');
            $('.sidebar').toggleClass('toggled');
        });
    });
</script>