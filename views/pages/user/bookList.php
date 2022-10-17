<?php
require "../../components/sidebar.php"
?>
<?php 
  if(isset($_POST['insert'])){
    unset($_POST['insert']);
    insert("peminjamans", $_POST);
    update("bukus", ['jumlah' => 'jumlah - 1'], "id = $_POST[id_buku]", true);
    $_SESSION['alert'] = [
        'color' => 'success',
        'msg' => 'Berhasil meminjam'
    ];
  }
?>
<?php
$books = select_all("bukus");
?>
<?php
dashboard_open()
?>
  <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Buku</h1>
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
                            <div class=" w-full p-0">
                                
                                <table class="table table-hover text-nowrap" id="datatable">
                                <thead>
                                    <tr>
                                    <th  class="text-center" scope="col">Judul Buku</th>
                                    <th  class="text-center" scope="col">Cover Buku</th>
                                    <th  class="text-center" scope="col">Unit Tersedia</th>
                                    <th  class="text-center" scope="col">Pinjam</th>
                                    </tr>
                                </thead>

                                <!-- Fetch Data from Database -->
                                
                                  <tbody> 
                                    <?php if($books != NULL && count($books) > 0){ foreach ($books as $book) { ?>
                                    <tr>
                                      <td class="text-center"><?= $book['judul'] ?></td>
                                      <td class="text-center"><img height="300" src="<?= url() ?>/assets/upload/<?= $book['cover'] ? $book['cover'] : 'noimage.png'  ?>  " alt=""></td>
                                      <td class="text-center"><?= $book['jumlah'] ?></td>   
                                      <td class="text-center"><button type="button" class="btn btn-primary" onclick="setEditModal(<?= $book['id'] ?>)" <?= ($book['jumlah'] == 0) ? "disabled" : "aw" ?>>Pinjam</button></td>
                                    </tr>
                                    <?php }} else{ ?>
                                      <tr>
                                        <td class="text-center" colspan="6">
                                            Data Buku belum tersedia
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
<div class="modal fade "   id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form class="modal-dialog validation" role="document" method="POST" action="" >
        <div class="modal-content" style="width : 600px" >
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Peminjaman</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" >
        <input type="hidden" name="id_buku">
        <input type="hidden" name="id_user" value="<?= $_SESSION['user']['id'] ?>">
        <input type="hidden" name="status" value="1">
          <div class="row mb-4" >
                  <div class="col-4 d-flex justify-content-center">
                      <img width="200" src="" alt="" id="imgCover" >
                  </div>
                  <div class="col-8">
                      <div class="form-group">
                          <label for="judul">Judul</label>
                          <input type="text" name="judul" class="form-control" value="" disabled  >
                      </div>
                      <div class="form-group">
                          <label for="genre">Tanggal Pinjam</label>
                          <input type="date" name="tanggal_pinjam" class="form-control" value="<?= date('Y-m-d') ?>" readonly >
                      </div>
                      <div class="form-group">
                          <label for="genre">Tanggal Kembali</label>
                          <input type="date" name="tanggal_kembali" class="form-control" value="<?= date('Y-m-d', strtotime("+7 day")) ?>" readonly >
                      </div>
                  </div>
              </div>
          </div>
        <div class="modal-footer">
            <input type="submit" value="Pinjam" id="modalSubmit" class="btn btn-primary" name="insert">

        </div>
        </div>
    </form>
</div>
<script>
   const books = JSON.parse('<?= addslashes(json_encode($books, JSON_UNESCAPED_UNICODE)) ?>')
   const url = '<?= url() ?>/assets/upload/'
    function setEditModal(id){
        let book = books.find(x => x.id == id)
        
        $('#imgCover').attr('src', url+ (book.cover ? book.cover : "noimage.png" ))
        $('input[name="judul"]').val(book.judul)
        $('input[name="id_buku"]').val(book.id)
        $('#exampleModal').modal('show');
    }
</script>
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