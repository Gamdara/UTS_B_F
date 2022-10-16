<?php require_once "../../../components/sidebar.php" ?>

<?php 
    $book = select_join("bukus", ["genres" => "(genres.id = bukus.id_genre)", "penulis" => "(penulis.id = bukus.id_penulis)"], "bukus.id = $_GET[id]", "bukus.*, genres.genre, penulis.nama")[0];
    $loans = select_join("peminjamans", ['users' => '(users.id = peminjamans.id_user)'], "id_buku = $_GET[id]", "peminjamans.*, users.nama");
    
?>

<?php dashboard_open() ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Peminjam Buku</h1>
                </div>
                <!-- /.col -->
                
                
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
            <div class="row mb-4">
                <div class="col-12 col-md-4 d-flex justify-content-center">
                    <img height="500" width="300" style="object-fit: contain;" src="<?= url() ?>/assets/upload/<?= $book['cover'] ? $book['cover'] : "noimage.png" ?>" alt="" readonly>
                </div>
                <div class="col-12 col-md-8">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control" value="<?= $book['judul'] ?>"   readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <input type="text" name="judul" class="form-control" value="<?= $book['genre'] ?>"   readonly>
                    </div>

                    <div class="form-group">
                        <label for="genre">Penulis</label>
                        <input type="text" name="judul" class="form-control" value="<?= $book['nama'] ?>"   readonly>
                    </div>

                    <div class="form-group">
                        <label for="judul">Jumlah</label>
                        <input type="text" name="judul" class="form-control" value="<?= $book['jumlah'] ?>"   readonly>
                    </div>

                    <div class="form-group">
                        <label for="judul">Sinopsis</label>
                        <textarea name="sinopsis" cols="30" rows="7" class="form-control" readonly><?= $book['sinopsis'] ?></textarea>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <div class="col-12 form-group row my-1">
                                    <label for="staticEmail" class="col-sm-1 col-form-label">Status</label>
                                    <div class="col-sm-11">
                                        <select name="id_genre" class="form-control col-4 mb-3" id="setStatus">
                                            <option value="all">Semua</option>
                                            <option value="1" selected>Sedang Dipinjam</option>
                                            <option value="0">Dikembalikan</option>
                                        </select>
                                    </div>
                                </div>

                                <table class="table table-hover text-nowrap" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Peminjam</th>
                                            <th class="text-center">Tanggal Pinjam</th>
                                            <th class="text-center">Tanggal Kembali</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data">
                                       
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
    
<?php  dashboard_close() ?>

<script>
    const loans = JSON.parse('<?= addslashes(json_encode($loans, JSON_UNESCAPED_UNICODE)) ?>')
    console.log(loans)

    function showData(status){
        console.log(status);
        let filtered = loans.filter(x => (x.status == status || status == "all"));
        console.log(filtered);
        if(filtered != undefined && filtered.length > 0){
            $('#data').empty();
            filtered.map(x => {
                $('#data').html( $('#data').html() + `
                    <tr>
                        <td class="text-center">${x.nama}</td>
                        <td class="text-center">${x.tanggal_pinjam}</td>
                        <td class="text-center">${x.tanggal_kembali}</td>
                        <td class="text-center">${x.status == 1 ? "Dipinjam" : "Dikembalikan"}</td>
                    </tr>  
                `)
            })
        }
        else{
            $('#data').empty();
            $('#data').html(`
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data</td>
                </tr>`
            );
        }
    }

    showData(1);
    $('#setStatus').change(function() { showData($('#setStatus').find(":selected").val()) })

    // $(function () {
    //     $("#datatable").DataTable({
    //     "pageLength": 5,
    //     "responsive": true, "lengthChange": false, "autoWidth": false
    //     }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
    // });

</script>