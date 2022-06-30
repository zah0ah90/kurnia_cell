<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KARUNIA CELL</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('asset/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('asset/') ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('asset/') ?>js/sweetalert2.min.css" rel="stylesheet">
    <script src="<?= base_url('asset/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('asset/') ?>js/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('asset/') ?>js/jquery.validate.min.js"></script>


</head>

<body id="page-top">
    <style>
        .error {
            font-size: 14px !important;
            width: 100% !important;
            color: red;
        }
    </style>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('asset/') ?>index.html">
                <div class="sidebar-brand-icon ">
                    <i class="fas fa-toolbox"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Karunia Cell</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>



            <!-- Heading -->
            <div class="sidebar-heading">
                Sparepart
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('barang/index') ?>">
                    <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
                    <i class="fas fa-fw fa-box"></i>
                    <span>Sparepart</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('barang/history_barang') ?>">
                    <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
                    <i class="fas fa-fw fa-box-open"></i>
                    <span>History Sparepart</span>
                </a>
            </li>

            <!-- Heading -->
            <div class="sidebar-heading">
                Transaksi
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('transaksi') ?>">
                    <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
                    <i class="fas fa-fw fa-shopping-basket"></i>
                    <span>Transaksi</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('transaksi/laporan') ?>">
                    <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
                    <i class="fas fa-fw fa-cart-arrow-down"></i>
                    <span>Laporan Transaksi</span>
                </a>
            </li>
            <?php if ($this->session->userdata('nama') == 'pemilik') { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('transaksi/margin') ?>">
                        <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
                        <i class="fas fa-fw fa-cart-arrow-down"></i>
                        <span>Laporan Margin</span>
                    </a>
                </li>
            <?php } ?>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('nama') ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('asset/') ?>img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">