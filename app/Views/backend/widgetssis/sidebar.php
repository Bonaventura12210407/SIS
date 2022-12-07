  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
    <div class="sidebar-brand-icon">
    <img src="<?=base_url('assets/img/suzuran.png')?>" width="60" height="60"  alt=""></img>
    </div>
    <div class="sidebar-brand-text mx-3">Sistem Informasi Sekolah</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?=base_url('siswa/dashboard')?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<div class="sidebar-heading">
    Siswa
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-graduation-cap"></i>
        <span>Data Siswa</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Referensi Data Siswa:</h6>
            <a class="collapse-item" href="<?=site_url('siswa')?>">Data Siswa</a>
            <a class="collapse-item" href="<?=site_url('kelassiswa')?>">Kelas Siswa</a>

            <div class="collapse-divider"></div>
        </div>
    </div>
</li>


<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="<?=site_url('jadwal')?>">
        <i class="fas fa-fw fa-bell"></i>
        <span>Jadwal Mata Pelajaran</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="<?=site_url('rincianpenilaian')?>">
        <i class="fas fa-fw fa-table"></i>
        <span>Rincian Penilaian Siswa</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>



</ul>
<!-- End of Sidebar -->