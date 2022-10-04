<?php require_once "../../../components/sidebar.php" ?>

<?php 
    if(isset($_POST['insert'])){
        unset($_POST['insert']);
        unset($_POST['id']);
        insert("genres", $_POST);
        $alert = [
            'color' => 'success',
            'msg' => 'Berhasil menambah genre'
        ];
    }

    if(isset($_POST['update'])){
        unset($_POST['update']);
        update("genres", $_POST, "id = $_POST[id]");
        $alert = [
            'color' => 'success',
            'msg' => 'Berhasil mengubah genre'
        ];
    }
    
    if(isset($_POST['delete'])){
        delete("genres", "id = $_POST[id]");
        $alert = [
            'color' => 'success',
            'msg' => 'Berhasil menghapus genre'
        ];
    }
?>

<?php 
    $genres = select_all("genres");
?>

<?php dashboard_open() ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Genre</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6 ">
                    <button class="btn btn-primary rounded-circle shadow float-sm-right" onclick="setInsertModal()">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                    <!-- <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?= url() ?>/views/pages/admin/genre/index.php">Genre</a>
                        </li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol> -->
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
                                            <th class="text-center">Genre</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($genres != NULL && count($genres) > 0){ foreach ($genres as $genre) { ?>
                                            <tr>
                                                <td class="text-center"><?= $genre['genre'] ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-success" onclick="setEditModal(<?= $genre['id'] ?>)"><i class="fa fa-pencil " aria-hidden="true"></i> </button>
                                                    <form action="" method="POST" class="d-inline-block">
                                                        <input type="hidden" name="id" value="<?= $genre['id'] ?>">
                                                        <input type="hidden" name="delete" value="1">
                                                        <button  class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
                                                </td>
                                            </tr>  
                                        <?php }} else{ ?>
                                            <div class="alert alert-danger">
                                                Data Genre belum tersedia
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
    <form class="modal-dialog validation" role="document" method="POST" action="" >
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
                <label for="genre">Genre</label>
                <input type="text" name="genre" class="form-control" id="genre" placeholder="Masukkan nama genre">
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" value="Simpan" id="modalSubmit" class="btn btn-primary">
        </div>
        </div>
    </form>
</div>
<script>
    const genres = JSON.parse('<?= json_encode($genres) ?>')

    function setEditModal(id){
        let genre = genres.find(x => x.id == id)
        console.log(genre);
        $('.modal-title').html('Edit Genre')
        $('input[name="genre"]').val(genre.genre)
        $('input[name="id"]').val(genre.id)
        $('#modalSubmit').attr('name', 'update')
        $('#exampleModal').modal('show');
    }

    function setInsertModal(){
        $('.modal-title').html('Tambah Genre')
        $('input[name="genre"]').val('')
        $('#modalSubmit').attr('name', 'insert')
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