<?php 
    require_once (dirname(__FILE__, 3).'/process/db.php') ;
    require_once (dirname(__FILE__, 3).'/process/functions.php') ;

    if(!isset($_SESSION['user'])){
        echo"
        <script>
            alert('Silahkan Login dulu');
            window.location.href = '".url()."';
        </script>
        ";
    }
    
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
    <link rel="stylesheet" href="<?= url() ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= url() ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= url() ?>/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= url() ?>/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= url() ?>\assets\css\adminlte.min.css">
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- My CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
            <ul class="navbar-nav" onclick="toggleIcon()">
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
                <div class="image icon-kecil  justify-content-center" style="display: none;">
                    <img style="height : 2.1rem !important" src="<?= url() ?>/assets/img/perpus-lay.png"
                        class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info icon-gede" style="display: block;">
                    <img src="<?= url() ?>/assets/img/PerpusKita.png" alt="PerpusKita Logo" width="200px"  class="brand-text m-3 font-weight-light" style="opacity: .8">
                </div>
                <!-- <span >a</span> -->
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                    <div class="image">
                        <img style="height : 2.1rem !important" src="<?= url() ?>/assets/upload/<?= $_SESSION['user']['foto'] ? $_SESSION['user']['foto'] : "user2-160x160.jpg" ?>"
                        class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info text-wrap">
                        <a href="<?= url() ?>/views/pages/user/editProfilePage.php" class="d-block"><?= $_SESSION['user']['nama'] ?></a>
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
                        <!-- kalo udah ada login, hapus 1 ||  -->
                        <?php if($_SESSION['user']['role'] == "admin"){ ?>
                        <li class="nav-item">
                            <a href="<?= url() ?>/views/pages/admin/genre/index.php"class="nav-link">
                                <i class="nav-icon fa-regular fa-bookmark"></i>
                                <p> Genre</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= url() ?>/views/pages/admin/buku/index.php"class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p> Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= url() ?>/views/pages/admin/peminjaman/index.php"class="nav-link">
                                <i class="nav-icon fas fa-book-reader"></i>
                                <p> Peminjaman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= url() ?>/views/pages/admin/user/index.php"class="nav-link">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p> User</p>
                            </a>
                        </li>
                        <?php } ?>
                        <!-- kalo udah ada login, hapus 1 ||  -->
                        <?php if($_SESSION['user']['role'] == "user") { ?>
                        <li class="nav-item">
                            <a href="<?= url() ?>/views/pages/user/booklist.php"class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p> List buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= url() ?>/views/pages/user/userbook.php"class="nav-link">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p> User buku</p>
                            </a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="<?= url() ?>/process/auth/logout.php"class="nav-link">
                                <i class="nav-icon far fa-logout"></i>
                                <p> Logout</p>
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
    <script src="<?= url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?= url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= url() ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= url() ?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= url() ?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= url() ?>/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= url() ?>/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= url() ?>/assets/plugins/jszip/jszip.min.js"></script>
    <script src="<?= url() ?>/assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= url() ?>/assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= url() ?>/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= url() ?>/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= url() ?>/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?= url() ?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= url() ?>/assets/js/adminlte.min.js"></script>
    <!-- My Script -->
    <script src="../../assets/js/script.js"></script>
    <!-- Bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <script>
        // const Swal = require('sweetalert2')
     
        <?php if(isset($_SESSION['alert'])){ ?>
            Swal.fire(
            '<?= $_SESSION['alert']['color'] == "success" ? "Sukses" : "Gagal" ?>',
            '<?= $_SESSION['alert']['msg'] ?>',
            '<?= $_SESSION['alert']['color'] ?>'
            )
        <?php unset($_SESSION['alert']); } ?>

    </script>
    
    <script>
        function toggleIcon(){
            console.log($('body').hasClass('sidebar-collapse'))
            if($('body').hasClass('sidebar-collapse')){
                $('.icon-kecil').css('display', 'none')
                $('.icon-gede').css('display', 'flex')
            }
            else{
                $('.icon-kecil').css('display', 'flex')
                $('.icon-gede').css('display', 'none')
            }
        }

        // $( document ).ready(function() {
        //     toggleIcon();
        // });
    </script>

    <script>
        function sweetConfirm(e, msg){
          
            Swal.fire({
            title: msg,
            showDenyButton: true,
            confirmButtonText: 'Ya',
            icon : 'question',
            denyButtonText: `Tidak`,
            }).then((result) => {
            
            if (result.isConfirmed) {
                $(e).parent().submit()
            } else if (result.isDenied) {
                return false;
            }
            })
            return false;
        }
    </script>
</body>
</html>
<?php } ?>