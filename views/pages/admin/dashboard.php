<?php require_once "../../components/sidebar.php" ?>
<?php dashboard_open() ?>
<?php
  $query = mysqli_query($con, "SELECT * FROM users WHERE id= ".$_SESSION['user']['id']);
  $data = mysqli_fetch_assoc($query);
?>

    <div class="content mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if($_SESSION['user']['role']=="admin") {?>
                                <h2 style="font-weight:700; text-align:center" class="animate__animated animate__bounceInDown mt-4 mb-4">Anda Masuk Sebagai <a href="<?= url() ?>/pages/user/editProfilePage.php" style="text-decoration:none"><?= $data['nama']?></a></h2>
                            
                            <?php }else {?>
                            <div class="mt-1 animate__animated animate__zoomIn" style="text-align:center">
                                <img src="<?= url() ?>/assets/img/image-hello.gif" alt="PerpusKita Logo" style="">
                            </div>
                            <h2 style="font-weight:800; text-align:center" class="animate__animated animate__bounceInDown">SELAMAT DATANG <br><a href="<?= url() ?>/pages/user/editProfilePage.php" style="text-decoration:none"><?= $data['nama']?></a>  di</h2>
                            <div class="animate__animated animate__fadeInUp mt-3 mb-3 gambar-dashboard" style="text-align:center">
                                <img src="<?= url() ?>/assets/img/PerpusKita.png" alt="PerpusKita Logo" style="">
                            </div>
                            <?php } ?>
                        </div>
                    <!-- /.card-body -->
                    </div>
                <!-- /.card -->
                </div>
            <!-- /.col-md-6 -->
            </div>
        <!-- /.row -->
        </div>
    <!-- /.container-fluid -->
    </div>

<?php dashboard_close() ?>