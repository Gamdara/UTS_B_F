<?php
require "../../components/sidebar.php"
?>
<?php 
  if(!empty($_POST)){
    unset($_POST['update']);
    update("peminjamans", ['status' => '0'], "id = $_POST[id]");
    update("bukus", ['jumlah' => 'jumlah + 1'], "id = $_POST[id_buku]", true);
    $_SESSION['alert'] = [
        'color' => 'success',
        'msg' => 'Berhasil mengembalikan'
    ];
  }
?>
<?php
$loans = select_join("peminjamans",["bukus" => "bukus.id = peminjamans.id_buku"], "id_user = ".$_SESSION['user']['id'], "peminjamans.*, bukus.judul, bukus.cover");
?>
<?php
dashboard_open()
?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Buku Yang Dipinjam</h1>
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
                            <div class=" p-0">
                                
                                <table class="table table-hover text-nowrap" id="datatable">
                                <thead>
                                    <tr>
                                    <th scope="col">Judul Buku</th>
                                    <th scope="col">Cover Buku</th>
                                    <th scope="col">Status Peminjaman</th>
                                    <th scope="col">Batas pengembalian</th>
                                    <th scope="col">Pengembalian Buku</th>
                                    </tr>
                                </thead>

                                <!-- Fetch Data from Database -->
                                <tbody>
                                  <?php if($loans != NULL && count($loans) > 0){ foreach ($loans as $loan) { ?>
                                  <tr>
                                    <td class="text-center"><?= $loan['judul'] ?></td>
                                    <td  class="text-center"><img height="200" src="<?=url()?>/assets/upload/<?= $loan['cover'] ? $loan['cover'] : 'noimage.png' ?>" alt=""></td>
                                    <td  class="text-center"><?= $loan['status'] == 1? 'dipinjam' : 'dikembalikan' ?></td>
                                    <td  class="text-center"><?= $loan['tanggal_kembali'] ?></td>
                                    <td  class="text-center">
                                      <?php if($loan['status']) { ?> 
                                        
                                        <form action="" method="POST" class="d-inline-block">
                                          <input type="hidden" name="id" value="<?= $loan['id'] ?>">
                                          <input type="hidden" name="id_buku" value="<?= $loan['id_buku'] ?>">
                                          <input value="Kembalikan" type="submit" name="update" class="btn btn-primary" onclick="return sweetConfirm(this, 'Yakin Mengembalikan?')" >
                                        </form>
                                        <?php } else{ ?>
                                          dikembalikan
                                        <?php } ?>
                                    </td>
                                  </tr>
                                  <?php }} else{ ?>
                                    <tr>
                                        <td class="text-center" colspan="5">
                                            Data Peminjaman belum tersedia
                                        </td>
                                      <tr>
                                  <?php } ?>
                                </tbody>           
                                </table>
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

  
<?php 
dashboard_close()
?>

<script>
   if ( window.history.replaceState ) {
       window.history.replaceState( null, null, window.location.href );
    }
  $(function () {
        $(".table").DataTable({
        "pageLength": 5,
        "responsive": true, "lengthChange": true, "autoWidth": true
        }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
    });

</script>
        