<?php require_once "../../../components/sidebar.php" ?>

<?php 
    if(isset($_POST['insert'])){
        unset($_POST['insert']);
        unset($_POST['id']);

        $_POST = upload_file($_POST, $_FILES);
        
        insert("bukus", $_POST);
        $alert = [
            'color' => 'success',
            'msg' => 'Berhasil menambah buku'
        ];
    }

    if(isset($_POST['update'])){
        unset($_POST['update']);
        update("bukus", $_POST, "id = $_POST[id]");
        $alert = [
            'color' => 'success',
            'msg' => 'Berhasil mengubah buku'
        ];
    }
    
    if(isset($_POST['delete'])){
        delete("bukus", "id = $_POST[id]");
        $alert = [
            'color' => 'success',
            'msg' => 'Berhasil menghapus buku'
        ];
    }
?>

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
                <div class="col-sm-6 ">
                    <button class="btn btn-primary rounded-circle shadow float-sm-right" onclick="setInsertModal()">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
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
                                                    <button class="btn btn-success" onclick="setEditModal(<?= $book['id'] ?>)"><i class="fa fa-pencil " aria-hidden="true"></i> </button>
                                                    <form action="" method="POST" class="d-inline-block">
                                                        <input type="hidden" name="id" value="<?= $book['id'] ?>">
                                                        <input type="hidden" name="delete" value="1">
                                                        <button  class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
                                                </td>
                                            </tr>  
                                        <?php }} else{ ?>
                                            <div class="alert alert-danger">
                                                Data Buku belum tersedia
                                            </div>
                                        <?php } ?>
                                        <?php if(isset($alert)){ ?>
                                            <div class="alert alert-<?= $alert['color'] ?> alert-dismissible fade show">
                                                <?= $alert['msg'] ?>
                                            </div>
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
    
<?php dashboard_close() ?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form class="modal-dialog validation" role="document" method="POST" action="" enctype="multipart/form-data" novalidate>
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Genre</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control"  placeholder="Masukkan judul" required>
            </div>
            
            <div class="form-group">
                <label for="genre">Genre</label>
                <select name="id_genre" class="form-control" required>
                    <option value="" id="phGenre" selected style="display: none;">Pilih Genre</option>
                    <?php foreach (select_all('genres') as $genre) { ?>
                        <option value="<?= $genre['id'] ?>"><?= $genre['genre'] ?></option>
                    <?php }?>
                </select>
            </div>

            <div class="form-group">
                <label for="judul">Jumlah</label>
                <input type="text" name="jumlah" class="form-control"  placeholder="Masukkan jumlah buku" required>
            </div>

            <div class="form-group">
                <label for="judul">Sinopsis</label>
                <textarea name="sinopsis" cols="30" rows="2" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="judul">Cover</label>
                <input type="file" name="cover" id="" class="form-control" >
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="submit" value="Simpan" id="modalSubmit" class="btn btn-primary">
        </div>
        </div>
    </form>
</div>
<script>
    const bukus = JSON.parse('<?= json_encode($books) ?>')

    function setEditModal(id){
        let buku = bukus.find(x => x.id == id)
        $('.modal-title').html('Edit Buku')
        $('#modalSubmit').attr('name', 'update')

        $('input[name="judul"]').val(buku.judul)
        $('input[name="jumlah"]').val(buku.jumlah)
        $('textarea[name="sinopsis"]').html(buku.sinopsis)
        $('select[name="id_genre"] option').each(function() {
            if ($(this).val() == buku.id_genre)
                $(this).prop('selected', true)
            else
                $(this).prop('selected', false)
        })

        $('input[name="id"]').val(buku.id)
        $('#phGenre').attr('selected', 'false')
        $('#exampleModal').modal('show');
    }

    function setInsertModal(){
        $('.modal-title').html('Tambah Buku')
        $('#modalSubmit').attr('name', 'insert')

        $('input[name="judul"]').val('')
        $('input[name="jumlah"]').val('')
        $('textarea[name="sinopsis"]').html('')
        $('form option').each(function()  {
            $(this).prop('selected', false)
        })
        $('#phGenre').prop('selected', true)
        $('#exampleModal').modal('show');
    }

    $(function () {
        $("#datatable").DataTable({
        "pageLength": 5,
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
    });

    if ( window.history.replaceState ) {
       window.history.replaceState( null, null, window.location.href );
    }

    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
    })()
</script>