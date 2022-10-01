<?php
require "../../components/sidebar.php"
?>
<?php
$loans = select_foreign("peminjamans","bukus","1");


?>
<?php
dashboard_open()
?>
  <link rel="stylesheet" href="../../../assets/css/style.css">
  <div class="form-popup" id="myForm">
      <form action="/action_page.php" class="form-container">
          <h1>Konfirmasi Pengembalian</h1>
          <input type="hidden" id="idbook" name="book_id">
          <button type="submit" class="btn">Yes</button>
          <button type="button" class="btn cancel" onclick="closeForm()" value="1">Close</button>
      </form>
  </div>

  <div class="container" id="table-book">
    <!-- Content -->
    <h1>Daftar Buku Yang Dipinjam</h1>
        <!-- Table Book -->
        <table class="table" >
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
        <?php if($loans != NULL && count($loans) > 0){ foreach ($loans as $loan) { ?>
        <tbody>
          <tr>
            <td class="text-center"><?= $loan['judul'] ?></td>
            <td><img src="../../../assets/upload/coverBook/<?= $loan['cover'] ?>.jpg" alt=""></td>
            <?php if($loan['status'] == 0){
                $loan['status'] = 'dipinjam';
              ?> 
                <td><?= $loan['status'] ?></td>
              <?php } else{ 
                $loan['status'] = 'Sudah dikembalikan';
              ?>
                <td><?= $loan['status'] ?></td>
              <?php } ?>
            <td><?= $loan['tanggal_kembali'] ?></td>
            <?php if($loan['status'] != 'dipinjam'){?>
              <td><button type="button" class="btn btn-primary" onclick="openForm()" value="<?= $loan['id'] ?>">Kembalikan</button></td>
              <?php } else{ ?>
              <td><div type="button" class="btn btn-danger" value="<?= $loan['id'] ?>">Kembalikan</div></td>
              <?php } ?>
          </tr>
        </tbody>                 
        <?php }} else{ ?>
          <div class="alert alert-danger">
            Data Buku belum tersedia
          </div>
        <?php } ?>
        
        </table>
    </div>
  <script src="../../../assets/js/script.js"></script>
<?php 
dashboard_close()
?>

          <tbody> 
            <tr>   
              <?php if($loan['status'] == 0){
                $loan['status'] = 'dipinjam';
              ?>              
              <td><div type="button" class="btn btn-danger" value="<?= $loan['id'] ?>">Kembalikan</div></td>
              <?php } else{ 
                $loan['status'] = 'Sudah dikembalikan';
              ?> 

              <td><button type="button" class="btn btn-primary" onclick="openForm()" value="<?= $loan['id'] ?>">Kembalikan</button></td> 
              <?php } ?>
            </tr>
          </tbody>          