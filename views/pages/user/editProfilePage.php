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

            <div class="content-header">
              <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                          <h1 class="m-0">Edit Profile</h1>
                      </div>
                  </div>
              </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                  <button class="btn btn-warning mb-3"><a href="#" style="text-decoration:none; color:white;" data-toggle="modal" data-target="#myModal"><b>Ubah Password?</b></a> </button>

                                  <form action="<?= url() ?>/process/auth/profil.php" method="post" enctype="multipart/form-data">
                                  <img height="150" src="<?= url() ?>/assets/upload/<?= $data['foto'] ? $data['foto'] : "noimage.png" ?>" alt="" style="border-radius: 50%; margin-bottom:15px">
                                  
                                      <div class="mb-3">
                                        <label for="input1" class="form-label">Nama</label>
                                        <input
                                          class="form-control"
                                          id="nama"
                                          name="nama"
                                          value="<?php echo $data['nama'] ?>" required
                                          <?php if($_SESSION['user']['role']=="admin") { ?>
                                            readonly
                                          <?php } ?>
                                          >
                                      </div>
                                      <div class="mb-3">
                                          <label for="input1" class="form-label">Email</label>
                                          <input
                                            class="form-control"
                                            id="email"
                                            name="email"
                                            value="<?php echo $data['email'] ?>" required
                                            <?php if($_SESSION['user']['role']=="admin") { ?>
                                                readonly
                                            <?php } ?>
                                            >
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
                                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                                      </div>
                                  </form>
                                  
                                  <!-- Modal -->
                                        <div id="myModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- konten modal-->
                                                <div class="modal-content">
                                                    <!-- heading modal -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Password</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        
                                                    </div>
                                                    <!-- body modal -->
                                                    <div class="modal-body">
                                                        <form action="<?= url() ?>/process/auth/editPassword.php" method="post" enctype="multipart/form-data">
                                                            <div class="mb-3">
                                                                <label for="input1" class="form-label">Password Lama</label>
                                                                <div class="input-group" id="show_hide_password">
                                                                    <input
                                                                    type="password"
                                                                    class="form-control"
                                                                    id="passwordLama"
                                                                    name="passwordLama" required>
                                                                    <div class="input-group-append">
                                                                        <a href="" class="btn btn-outline-secondary" style="border: 1px solid #ced4da;"><i class="fa-regular fa-eye-slash" aria-hidden="true"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="input1" class="form-label">Password Baru</label>
                                                                <div class="input-group" id="show_hide_password2">
                                                                    <input
                                                                    type="password"
                                                                    class="form-control"
                                                                    id="passwordBaru"
                                                                    name="passwordBaru" required>
                                                                    <div class="input-group-append">
                                                                        <a href="" class="btn btn-outline-secondary" style="border: 1px solid #ced4da;"><i class="fa-regular fa-eye-slash" aria-hidden="true"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="input1" class="form-label">Konfirmasi Password Baru</label>
                                                                <div class="input-group" id="show_hide_password3">
                                                                    <input
                                                                    type="password"
                                                                    class="form-control"
                                                                    id="konfPasswordBaru"
                                                                    name="konfPasswordBaru" required>
                                                                    <div class="input-group-append">
                                                                        <a href="" class="btn btn-outline-secondary" style="border: 1px solid #ced4da;"><i class="fa-regular fa-eye-slash" aria-hidden="true"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- footer modal -->
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary" name="updatePass">Update Password</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                            
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
            
        </aside>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous">
            
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').removeClass( "fa-regular fa-eye" );
                    $('#show_hide_password i').addClass( "fa-regular fa-eye-slash" );
                    
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-regular fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-regular fa-eye" );
                }
            });
            $("#show_hide_password2 a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password2 input').attr("type") == "text"){
                    $('#show_hide_password2 input').attr('type', 'password');
                    $('#show_hide_password2 i').removeClass( "fa-regular fa-eye" );
                    $('#show_hide_password2 i').addClass( "fa-regular fa-eye-slash" );
                    
                }else if($('#show_hide_password2 input').attr("type") == "password"){
                    $('#show_hide_password2 input').attr('type', 'text');
                    $('#show_hide_password2 i').removeClass( "fa-regular fa-eye-slash" );
                    $('#show_hide_password2 i').addClass( "fa-regular fa-eye" );
                }
            });
            $("#show_hide_password3 a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password3 input').attr("type") == "text"){
                    $('#show_hide_password3 input').attr('type', 'password');
                    $('#show_hide_password3 i').removeClass( "fa-regular fa-eye" );
                    $('#show_hide_password3 i').addClass( "fa-regular fa-eye-slash" );
                    
                }else if($('#show_hide_password3 input').attr("type") == "password"){
                    $('#show_hide_password3 input').attr('type', 'text');
                    $('#show_hide_password3 i').removeClass( "fa-regular fa-eye-slash" );
                    $('#show_hide_password3 i').addClass( "fa-regular fa-eye" );
                }
            });
        });
    </script>
    </body>
</html>
<?php
    dashboard_close()
?>