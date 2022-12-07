<?=$this->extend('backend/template')?>

<?=$this->section('content')?>
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
   
</div>
<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Tentang Sekolah Kami</h6>
                <div class="dropdown no-arrow">
                
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                <img src="<?=base_url('assets/img/sekolah1.jpg')?>" width="693" height="320" alt=""></img>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Informasi Singkat Sekolah</h6>
           
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                <p>Halo Selamat Datang Di Website Sekolah ini.<tr> Website ini merupakan tugas project
                    Web Programing Kami di smester 3 dan akan menjadi nilai akhir mata kuliah Web Programing kami.
                </p>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                       <i>Informasi Singkat Website Kami</i>
                    </span>
                 
                </div>
                
                
            </div>
            
            
        </div>
    </div>
</div>
<div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-dark">Data Siswa</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Siswa Asal <span
                                            class="float-right">50%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 50%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Siswa Pindahan <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold"> Siswa Keluar <span
                                            class="float-right">10%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 10%"
                                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>


 
         
<?=$this->endSection()?>
