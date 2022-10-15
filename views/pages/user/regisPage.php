<?php include"../../../process/functions.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= url() ?>/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="<?= url() ?>/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= url() ?>\assets\css\adminlte.min.css">
    <title>Daftar Akun</title>
    <link rel="shortcut icon" href="<?= url() ?>/assets/img/gambar-favicon.png">
</head>
<body>
  <div id="header-container">
    <div id="header"></div>
    <div class="logo-project">
      <img src="<?= url() ?>/assets/img/PerpusKita.png" alt="Logo">
    </div>
  </div>
  <div class="body-daftar">
      <div class="form-regis">
          <fieldset>
              <legend>DAFTAR</legend>
              <p>Selamat Datang di Perpustakaan Kita,<br>Silakan melakukan daftar akun untuk dapat melanjutkan...</p>
              <div class="card bg-transparent m-4 mt-5 p-4 ">
                  <form action="<?= url() ?>/process/auth/register.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                          <label for="input1" class="form-label">Nama</label>
                          <input
                            class="form-control"
                            id="nama"
                            name="nama" 
                            placeholder="Masukkan Nama" required>
                        </div>
                        <div class="mb-3">
                          <label for="input1" class="form-label">Email</label>
                          <input
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="example@gmail.com" required>
                        </div>
                        <div class="mb-3">
                          <label for="input1" class="form-label">Password</label>
                          <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password" 
                            placeholder="Masukkan Password" required>
                        </div>
                        <div class="mb-3">
                          <label>Upload Foto</label>
                          <input
                            type="file"
                            class="form-control"
                            id="file"
                            name="foto" required>
                        </div>

                        <div class="d-grid gap-2">
                          <button type="submit" class="btn btn-primary" name="daftar">Daftar</button>
                        </div>
                        <p class="mt-2 mb-0">Sudah punya akun?<a href="<?= url() ?>/views/pages/user/loginPage.php" class="textprimary">Masuk</a></p>
                      </form>
              </div>
          </fieldset>
      </div>
  </div>
  <script src="<?= url() ?>/assets/plugins/jquery/jquery.min.js"></script>
  <script src="<?= url() ?>/assets/js/adminlte.min.js"></script>
  <script src="<?= url() ?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

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
    
</body>
</html>