<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Administrator
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link"
            href="<?= base_url('admin'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Siswa
    </div>

    <li class="nav-item">
        <a class="nav-link"
            href="<?= base_url('admin') ?>/daftarsiswa">
            <i class="fas fa-fw fa-user"></i>
            <span>Daftar Siswa</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
            href="<?= base_url('admin') ?>/daftarnilai">
            <i class="fas fa-fw fa-user"></i>
            <span>Daftar Nilai</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Test
    </div>

    <li class="nav-item">
        <a class="nav-link"
            href="<?= base_url('admin') ?>/paketsoal">
            <i class="fas fa-fw fa-user"></i>
            <span>Paket Soal</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link"
            href="<?= base_url('admin/deskripsikuis') ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Deskripsi Kuis</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->