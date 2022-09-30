<?php require_once "../../../components/sidebar.php" ?>
<?php 
    $books = select_all_join("bukus", ['genres' => 'bukus.id_genre = genres.id']);
?>
<?php dashboard_open() ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Buku</h1>
                </div>
                    <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?= url() ?>/views/pages/admin/buku/index.php">Buku</a>
                        </li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div>
                    <!-- /.col -->
            </div>
                    <!-- /.row -->
        </div>
                    <!-- /.container-fluid -->
    </div>
                    <!-- /.content-header -->
                    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table table-hover text-nowrap" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Judul</th>
                                            <th class="text-center">Genre</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Sinopsis</th>
                                            <th class="text-center">Cover</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($books != NULL && count($books) > 0){ foreach ($books as $book) { ?>
                                            <tr>
                                                <td class="text-center"><?= $book['judul'] ?></td>
                                                <td class="text-center"><?= $book['genre'] ?></td>
                                                <td class="text-center"><?= $book['jumlah'] ?></td>
                                                <td class="text-center"><?= $book['sinopsis'] ?></td>
                                                <td class="text-center">
                                                    <img height="100" src="<?= url() ?>/assets/upload/<?= $book['cover'] ? $book['cover'] : "noimage.png" ?>" alt="">
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-success"><i class="fa fa-pencil " aria-hidden="true"></i> </button>
                                                    <button  class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>  
                                        <?php }} else{ ?>
                                            <div class="alert alert-danger">
                                                Data Buku belum tersedia
                                            </div>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center w-full">
                                    <!-- {{ $departemen->onEachSide(5)->links() }} -->
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
<?php dashboard_close() ?>
<script>
  $(function () {
    $("#datatable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
  });
</script>