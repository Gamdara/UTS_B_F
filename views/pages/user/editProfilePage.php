<?php
    require "../../components/sidebar.php"
?>
<?php
    dashboard_open()
?>
<?php
  $query = mysqli_query($con, "SELECT * FROM users WHERE id= ".$_SESSION['user']['id']);
  $data = mysqli_fetch_assoc($query);
?>

            <div class="content p-3 m-4 " style="background-color: #FFFFFF; border-top: 5px solid #D40013; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" >
                <div class="body d-flex justify-content-between">
                    <h4>EDIT PROFILE</h4> 
                </div>
                <hr>
                <form action="<?= url() ?>/process/auth/profil.php" method="post" enctype="multipart/form-data">
                <img height="150" src="<?= url() ?>/assets/upload/<?= $data['foto'] ? $data['foto'] : "noimage.png" ?>" alt="" style="border-radius: 50%; margin-bottom:15px">
                
                    <div class="mb-3">
                      <label for="input1" class="form-label">Nama</label>
                      <input
                        class="form-control"
                        id="nama"
                        name="nama"
                        value="<?php echo $data['nama'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="input1" class="form-label">Email</label>
                        <input
                          class="form-control"
                          id="email"
                          name="email"
                          value="<?php echo $data['email'] ?>" required>
                      </div>
                      <div class="mb-3">
                        <label>Ubah Foto</label>
                          <input
                            type="file"
                            class="form-control"
                            id="file"
                            
                            name="foto" require>
                      </div>

                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-secondary" name="update">Update</button>
                    </div>
                </form>
                    
            </div>
        </aside>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous">
        </script>
    </body>
</html>
<?php
    dashboard_close()
?>