<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rainbrow Career Path</title>
    
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laptop"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Rainbrow Career Path</div>
            </a>
            
            <hr class="sidebar-divider my-0">
            
            <li class="nav-item <?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <hr class="sidebar-divider">
            
            <div class="sidebar-heading">Data Master</div>
            
            <li class="nav-item <?= $this->uri->segment(1) == 'pelamar' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('pelamar') ?>">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Pelamar</span>
                </a>
            </li>
            
            <li class="nav-item <?= $this->uri->segment(1) == 'training' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('training') ?>">
                    <i class="fas fa-fw fa-graduation-cap"></i>
                    <span>Training</span>
                </a>
            </li>
            
            <li class="nav-item <?= $this->uri->segment(1) == 'karyawan' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('karyawan') ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Karyawan</span>
                </a>
            </li>
            
            <li class="nav-item <?= $this->uri->segment(1) == 'trainer' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('trainer') ?>">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                    <span>Trainer</span>
                </a>
            </li>
            
            <hr class="sidebar-divider">
            
            <div class="sidebar-heading">Master Data</div>
            
            <li class="nav-item <?= $this->uri->segment(1) == 'status' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('status') ?>">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Status</span>
                </a>
            </li>
            
            <li class="nav-item <?= $this->uri->segment(1) == 'departemen' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('departemen') ?>">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Departemen</span>
                </a>
            </li>
            
            <li class="nav-item <?= $this->uri->segment(1) == 'level_jabatan' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('level_jabatan') ?>">
                    <i class="fas fa-fw fa-layer-group"></i>
                    <span>Level Jabatan</span>
                </a>
            </li>
            
            <li class="nav-item <?= $this->uri->segment(1) == 'sumber' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('sumber') ?>">
                    <i class="fas fa-fw fa-broadcast-tower"></i>
                    <span>Sumber</span>
                </a>
            </li>
            
            <hr class="sidebar-divider">
            
            <div class="sidebar-heading">Laporan</div>
            
            <li class="nav-item <?= $this->uri->segment(1) == 'laporan' && $this->uri->segment(2) == 'pelamar' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('laporan/pelamar') ?>">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>Laporan Pelamar</span>
                </a>
            </li>
            
            <li class="nav-item <?= $this->uri->segment(1) == 'laporan' && $this->uri->segment(2) == 'training' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('laporan/training') ?>">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Laporan Training</span>
                </a>
            </li>
            
            <hr class="sidebar-divider d-none d-md-block">
            
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            
        </ul>
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    
                    <div class="mr-auto ml-md-3">
                        <h6 class="m-0 text-gray-600">
                            <!-- <i class="fas fa-calendar-alt mr-2"></i> -->
                            <span id="datetime"><?= date('l, d F Y - H:i:s') ?></span>
                        </h6>
                    </div>
                    
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">RAINBROW CAREER PATH</span>
                                <!-- <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile.jpg') ?>"> -->
                            </a>
                        </li>
                    </ul>
                </nav>
                
                <div class="container-fluid">