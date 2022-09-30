<?php 
    function url(){
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        
        return $protocol . "://" . $_SERVER['HTTP_HOST'] .dirname($_SERVER["REQUEST_URI"],count(explode('/',$_SERVER["REQUEST_URI"])) - 2);
        // return dirname(__FILE__, 3);
    }
    
    require_once (dirname(__FILE__, 3).'/process/db.php') ;
    require_once (dirname(__FILE__, 3).'/process/functions.php') ;
?>
<?php  function dashboard_open(){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TUBES F</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= url() ?>\assets\css\adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"
                    role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search"
                    href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar"
                                    type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar"
                                        type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen"
                    href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="<?= url() ?>/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Amsang Tech</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= url() ?>/assets/img/user2-160x160.jpg"
                        class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?= url() ?>/views/pages/admin/dashboard.php" class="d-block">ADMIN</a>
                    </div>
                </div>
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= url() ?>/views/pages/admin/buku/index.php"class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p> Buku</p>
                            </a>
                        </li>
                        
                    </ul>
                </nav>
            <!-- /.sidebar-menu -->
            </div>
        <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
<?php  }
function dashboard_close(){ ?>
            
        </div>
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline"> 
                Kelompok F
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 
                <a href="#">AdminLTE.io</a>. 
            </strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="<?= url() ?>/assets/plugins/jquery/jquery.min.js'"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= url() ?>/assets/plugins/js/bootstrap.bundle.min.js'"></script>
    <!-- AdminLTE App -->
    <script src="<?= url() ?>/assets/plugins/js/adminlte.min.js'"></script>
</body>
</html>
<?php } ?>