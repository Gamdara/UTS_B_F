<?php require_once "../../../components/sidebar.php" ?>

<?php 
    if(isset($_POST['insert'])){
        unset($_POST['insert']);
        unset($_POST['id']);

        if(verify_files($_FILES)["status"]){
            if( verify_files($_FILES)["status"] !== "empty")
                $_POST = upload_file($_POST, $_FILES);
            
            insert("penulis", $_POST);
            $_SESSION['alert'] = [
                'color' => 'success',
                'msg' => 'Berhasil menambah penulis'
            ];    
        }
        else{
            $_SESSION['alert'] = [
                'color' => 'error',
                'msg' => verify_files($_FILES)["msg"]
            ];
        }
    }

    if(isset($_POST['update'])){
        unset($_POST['update']);
        
        if(verify_files($_FILES)["status"]){
            if( verify_files($_FILES)["status"] !== "empty")
                $_POST = upload_file($_POST, $_FILES);

            update("penulis", $_POST, "id = $_POST[id]");
            $_SESSION['alert'] = [
                'color' => 'success',
                'msg' => 'Berhasil mengubah penulis'
            ];    
        }
        else{
            $_SESSION['alert'] = [
                'color' => 'error',
                'msg' => verify_files($_FILES)["msg"]
            ];
        }

    }
    
    if(isset($_POST['delete'])){
        delete("penulis", "id = $_POST[id]");
        $_SESSION['alert'] = [
            'color' => 'success',
            'msg' => 'Berhasil menghapus penulis'
        ];
    }
?>

<?php 
    $penulis = select_all("penulis");
?>

<?php dashboard_open() ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penulis</h1>
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
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Asal</th>
                                            <th class="text-center">Tanggal Lahir</th>
                                            <th class="text-center">Foto</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($penulis != NULL && count($penulis) > 0){ foreach ($penulis as $pen) { ?>
                                            <tr>
                                                <td class="text-center"><?= $pen['nama'] ?></td>
                                                <td class="text-center"><?= $pen['asal'] ?></td>
                                                <td class="text-center"><?= $pen['tl'] ?></td>
                                                <td class="text-center">
                                                    <img height="100" src="<?= url() ?>/assets/upload/<?= $pen['foto'] ? $pen['foto'] : "noimage.png" ?>" alt="">
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-success" onclick="setEditModal(<?= $pen['id'] ?>)"><i class="fa fa-pencil " aria-hidden="true"></i> </button>
                                                    <form action="" method="POST" class="d-inline-block">
                                                        <input type="hidden" name="id" value="<?= $pen['id'] ?>">
                                                        <input type="hidden" name="delete" value="1">
                                                        <button  class="btn btn-danger" onclick="return sweetConfirm(this, 'Yakin ingin menghapus?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
                                                </td>
                                            </tr>  
                                            
                                        <?php }} else{ ?>
                                            <tr>
                                                <td class="text-center" colspan="6">
                                                    Data penulis belum tersedia
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
    
<?php dashboard_close() ?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form class="modal-dialog validation" role="document" method="POST" action="" enctype="multipart/form-data" novalidate>
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah penulis</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id">
            
            <div class="form-group">
                <label for="judul">Nama</label>
                <input type="text" name="nama" class="form-control"  placeholder="Masukkan nama" required>
            </div>
            
            <div class="form-group">
                <label for="judul">Asal</label>
                <input type="text" name="asal" class="form-control"  placeholder="Masukkan asal" required>
            </div>

            <div class="form-group">
                <label for="judul">Tanggal Lahir </label>
                <input type="date" name="tl" class="form-control"  placeholder="Masukkan Tanggal Lahir" required>
            </div>

            <div class="form-group">
                <label for="judul">Foto</label>
                <input type="file" name="foto" id="" class="form-control" >
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="submit" value="Simpan" id="modalSubmit" class="btn btn-primary">
        </div>
        </div>
    </form>
</div>
<script>
    
    const penulis = JSON.parse('<?= addslashes(json_encode($penulis, JSON_UNESCAPED_UNICODE)) ?>')

    function setEditModal(id){
        let user = penulis.find(x => x.id == id)
        $('.modal-title').html('Edit Penulis')
        $('#modalSubmit').attr('name', 'update')

        $('input[name="nama"]').val(user.nama)
        $('input[name="asal"]').val(user.asal)
        $('input[name="tl"]').val(user.tl)

        $('input[name="id"]').val(user.id)
        $('#exampleModal').modal('show');
    }

    function setInsertModal(){
        $('.modal-title').html('Tambah User')
        $('#modalSubmit').attr('name', 'insert')

        $('input[name="nama"]').val('')
        $('input[name="asal"]').val('')
        $('input[name="tl"]').val('')

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