<?php include"../../../process/functions.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= url() ?>/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>Masuk</title>
    <link rel="shortcut icon" href="image/gambar-favicon.png">
</head>
<body>
    <div id="header-container">
        <div id="header"></div>
        <div class="logo-project">
          <img src="image/PerpusKita.png" alt="Logo">
        </div>
    </div>
    <div class="body-login">
        <div class="gambar-login">
            <img src="image/perpus-lay.png" alt="Welcome Perpustakaan">
        </div>
        <div class="form-login">
            <fieldset>
                <legend>MASUK</legend>
                <p>Selamat Datang di Perpustakaan Kita,<br>Silakan Masuk untuk melanjutkan...</p>
                <div class="card bg-transparent m-4 mt-5 p-4 ">
                    <form action="../process/auth/login.php" method="post">
                          <div class="mb-3">
                            <label for="input1" class="form-label">Email</label>
                            <input
                              class="form-control"
                              id="email"
                              name="email"
                              aria-describedby="emailHelp" 
                              placeholder="Masukkan Email" required>
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
                          <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name="submit">Masuk</button>
                          </div>
                          <p class="mt-2 mb-0">Belum punya akun?<a href="../user/regisPage.php" class="textprimary">Daftar</a></p>
                        </form>
                </div>
            </fieldset>
        </div>
    </div>
    
</body>
</html>