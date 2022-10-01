<?php
require "../../components/sidebar.php"
?>
<?php
$books = select_all("bukus");
?>
<?php
dashboard_open()
?>
  <link rel="stylesheet" href="../../../assets/css/style.css">
  <div class="form-popup" id="myForm">
      <form action="/action_page.php" class="form-container">
          <h1>Konfirmasi Peminjaman</h1>
          <P>Pinjam Buku untuk 7 hari?</P>
          <input type="hidden" id="idbook" name="book_id">
          <button type="submit" class="btn">Yes</button>
          <button type="button" class="btn cancel" onclick="closeForm()" value="1">Close</button>
      </form>
  </div>

  <div class="container" id="table-book">
    <!-- Content -->
    <h1>Daftar Buku yang tersedia</h1>
        <!-- Table Book -->
        <table class="table" >
        
        <thead>
            <tr>
            <th scope="col">Judul Buku</th>
            <th scope="col">Cover Buku</th>
            <th scope="col">Unit Tersedia</th>
            <th scope="col">Pinjam</th>
            </tr>
        </thead>

        <!-- Fetch Data from Database -->
        <?php if($books != NULL && count($books) > 0){ foreach ($books as $book) { ?>
          <tbody> 
            <tr>
              <td class="text-center"><?= $book['judul'] ?></td>
              <td><img src="../../../assets/upload/coverBook/<?= $book['cover'] ?>.jpg" alt=""></td>
              <td><?= $book['jumlah'] ?></td>   
              <?php if($book['jumlah'] != 0){?>
              <td><button type="button" class="btn btn-primary" onclick="openForm()" value="<?= $book['id'] ?>">Pinjam</button></td>
              <?php } else{ ?>
              <td><div type="button" class="btn btn-danger" value="<?= $book['id'] ?>">Pinjam</div></td>
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