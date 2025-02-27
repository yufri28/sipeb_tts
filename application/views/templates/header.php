<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Sistem Informasi Pendataan Barang - BPBD Kab TTS</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="<?=base_url("assets/img/kaiadmin/logo-dinas.png");?>" type=" image/x-icon" />

    <!-- Fonts and icons -->
    <script src="<?=base_url("assets/js/plugin/webfont/webfont.min.js");?>"></script>
    <script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ['<?=base_url("assets/css/fonts.min.css");?>'],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
    </script>


    <!-- CSS Files -->
    <link rel="stylesheet" href="<?=base_url("assets/css/bootstrap.min.css");?>" />
    <link rel="stylesheet" href="<?=base_url("assets/css/plugins.min.css");?>" />
    <link rel="stylesheet" href="<?=base_url("assets/css/kaiadmin.min.css");?>" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?=base_url("assets/css/demo.css");?>" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="<?=base_url("dashboard");?>" class="logo">
                        <img src="<?=base_url("assets/img/kaiadmin/logo-dinas.png");?>" alt="navbar brand"
                            class="navbar-brand" height="40" /> <span class="text-white ms-2 fw-bold">BPBD</span>
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <?php if($this->session->userdata('role') != 'pengguna' && $this->session->userdata('role') != 'kepala_dinas'):?>
                        <li class="nav-item <?=$menu == 'dashboard'?'active':'';?>">
                            <a href="<?=base_url("dashboard");?>">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item <?=$menu == 'masterdata'?'active':'';?>">
                            <a href="<?=base_url("masterdata");?>">
                                <i class="fas fa-table"></i>
                                <p>Master Data</p>
                            </a>
                        </li>
                        <li class="nav-item <?=$menu == 'stokbarang'?'active':'';?>">
                            <a href="<?=base_url("stokbarang");?>">
                                <i class="fas fa-luggage-cart"></i>
                                <p>Stok Barang</p>
                            </a>
                        </li>
                        <li class="nav-item <?=$menu == 'databencana'?'active':'';?>">
                            <a href="<?=base_url("databencana");?>">
                                <i class="fas fa-fire"></i>
                                <p>Data Bencana</p>
                            </a>
                        </li>
                        <li class="nav-item <?=$menu == 'barangmasuk'?'active':'';?>">
                            <a href="<?=base_url("barangmasuk");?>">
                                <i class="fas fa-arrow-down"></i>
                                <p>Barang Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item <?=$menu == 'barangkeluar'?'active':'';?>">
                            <a href="<?=base_url("barangkeluar");?>">
                                <i class="fas fa-arrow-up"></i>
                                <p>Barang Keluar</p>
                            </a>
                        </li>
                        <?php if($this->session->userdata('role') == 'administrator'):?>
                        <li class="nav-item <?=$menu == 'users'?'active':'';?>">
                            <a href="<?=base_url("users");?>">
                                <i class="fas fa-users"></i>
                                <p>Pengguna</p>
                            </a>
                        </li>
                        <?php endif;?>
                        <?php elseif($this->session->userdata('role') == 'pengguna'):?>
                        <li class="nav-item <?=$menu == 'dashboard'?'active':'';?>">
                            <a href="<?=base_url("useraccess");?>">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item <?=$menu == 'peminjaman'?'active':'';?>">
                            <a href="<?=base_url("useraccess/peminjaman");?>">
                                <i class="fa fa-handshake"></i>
                                <p>Peminjaman</p>
                            </a>
                        </li>
                        <?php elseif($this->session->userdata('role') == 'kepala_dinas'):?>
                        <li class="nav-item <?=$menu == 'dashboard'?'active':'';?>">
                            <a href="<?=base_url("hodaccess");?>">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item <?=$menu == 'peminjaman'?'active':'';?>">
                            <a href="<?=base_url("hodaccess/peminjaman");?>">
                                <i class="fa fa-handshake"></i>
                                <p>Peminjaman</p>
                            </a>
                        </li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="<?=base_url("dashboard");?>" class="logo">
                            <img src="<?=base_url("assets/img/kaiadmin/logo-dinas.png");?>" alt="navbar brand"
                                class="navbar-brand" height="40" /> <span class="text-white ms-2 fw-bold">BPBD</span>
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                    aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search ..." class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="<?=base_url("assets/img/profile.jpg");?>" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold"><?=$this->session->userdata('name');?></span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="<?=base_url("assets/img/profile.jpg");?>"
                                                        alt="image profile" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4><?=$this->session->userdata('name');?>
                                                    </h4>
                                                    <p class="text-muted">
                                                        <?=$this->session->userdata('role');?>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="<?=base_url('logout')?>">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>