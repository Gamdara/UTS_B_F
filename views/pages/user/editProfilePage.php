<?php
    require "../../components/sidebar.php"

?>

<?php
  $query = mysqli_query($con, "SELECT * FROM users WHERE id=".$_SESSION['user']['id']);
  $data = mysqli_fetch_assoc($query);
?>

            <div class="container p-3 m-4 h-100" style="background-color: #FFFFFF; border-top: 5px solid #D40013; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" >
                <div class="body d-flex justify-content-between">
                    <h4>EDIT PROFILE</h4> 
                </div>
                <hr>
                <form action="../../../process/auth/profil.php" method="post">
                <img src="$data['foto']" width='90' height='90' style="border-radius: 50%"/>
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
                            value="<?php echo $data['foto'] ?>"
                            name="foto" required>
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
