<?php require_once "../../../components/sidebar.php" ?>

<?php 
    if(isset($_POST['insert'])){
        unset($_POST['insert']);
        unset($_POST['id']);

        insert("peminjamans", $_POST);
        $_SESSION['alert'] = [
            'color' => 'success',
            'msg' => 'Berhasil menambah peminjaman'
        ];            
        
    }

    if(isset($_POST['update'])){
        unset($_POST['update']);

        update("peminjamans", $_POST, "id = $_POST[id]");
        $_SESSION['alert'] = [
            'color' => 'success',
            'msg' => 'Berhasil mengubah peminjaman'
        ];    
        

    }
    
    if(isset($_POST['delete'])){
        delete("peminjamans", "id = $_POST[id]");
        $_SESSION['alert'] = [
            'color' => 'success',
            'msg' => 'Berhasil menghapus peminjaman'
        ];
    }
?>

<?php 
    $loans = select_all_join("peminjamans", ['bukus' => 'bukus.id = peminjamans.id_buku', 'users' => 'users.id = peminjamans.id_user'], "peminjamans.*, bukus.judul, users.nama");
?>

<?php dashboard_open() ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Peminjaman</h1>
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
                                <table class="table table-hover  text-nowrap" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Judul</th>
                                            <th class="text-center">Nama Peminjam</th>
                                            <th class="text-center">Tanggal Pinjam</th>
                                            <th class="text-center">Tanggal Kembali</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($loans != NULL && count($loans) > 0){ foreach ($loans as $loan) { ?>
                                            <tr>
                                                <td class="text-center"><?= $loan['judul'] ?></td>
                                                <td class="text-center"><?= $loan['nama'] ?></td>
                                                <td class="text-center"><?= $loan['tanggal_pinjam'] ?></td>
                                                <td class="text-center"><?= $loan['tanggal_kembali'] ?></td>
                                                <td class="text-center"><?= $loan['status'] == 1 ? "sedang dipinjam" : "dikembalikan" ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-success" onclick="setEditModal(<?= $loan['id'] ?>)"><i class="fa fa-pencil " aria-hidden="true"></i> </button>
                                                    <form action="" method="POST" class="d-inline-block">
                                                        <input type="hidden" name="id" value="<?= $loan['id'] ?>">
                                                        <input type="hidden" name="delete" value="1">
                                                        <button  class="btn btn-danger" onclick="return sweetConfirm(this, 'Yakin ingin menghapus?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
                                                </td>
                                            </tr>  
                                        <?php }} else{ ?>
                                            <tr>
                                                <td class="text-center" colspan="6">
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
    
<?php dashboard_close() ?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form class="modal-dialog validation" role="document" method="POST" action="" enctype="multipart/form-data" novalidate>
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Peminjaman</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
                <label for="genre">Buku</label>
                <select name="id_buku" class="form-control" required>
                    <option value="" id="phBuku" selected style="display: none;">Pilih Buku</option>
                    <?php foreach (select_all('bukus') as $buku) { ?>
                        <option value="<?= $buku['id'] ?>"><?= $buku['judul'] ?></option>
                    <?php }?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="genre">Peminjam</label>
                <select name="id_user" class="form-control" required>
                    <option value="" id="phUser" selected style="display: none;">Pilih User</option>
                    <?php foreach (select_all('users') as $user) { ?>
                        <option value="<?= $user['id'] ?>"><?= $user['nama'] ?></option>
                    <?php }?>
                </select>
            </div>

            <div class="form-group">
                <label for="judul">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="form-control"   required>
            </div>

            <div class="form-group">
                <label for="judul">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" class="form-control"   required>
            </div>

            <div class="form-group">
                <label for="judul">Status</label>
                <select name="status" class="form-control" required>
                    <option value="1" >Dipinjam</option>
                    <option value="0" >Dikembalikan</option>
                </select>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="submit" value="Simpan" id="modalSubmit" class="btn btn-primary">
        </div>
        </div>
    </form>
</div>
<script>
    
    const loans = JSON.parse('<?= addslashes(json_encode($loans, JSON_UNESCAPED_UNICODE)) ?>')

    function setEditModal(id){
        let loan = loans.find(x => x.id == id)
        $('.modal-title').html('Edit Peminjaman')
        $('#modalSubmit').attr('name', 'update')

        $('input[name="tanggal_pinjam"]').val(loan.tanggal_pinjam)
        $('input[name="tanggal_kembali"]').val(loan.tanggal_kembali)
        $('select[name="id_user"] option').each(function() {
            if ($(this).val() == loan.id_user)
                $(this).prop('selected', true)
            else
                $(this).prop('selected', false)
        })
        $('select[name="id_buku"] option').each(function() {
            if ($(this).val() == loan.id_buku)
                $(this).prop('selected', true)
            else
                $(this).prop('selected', false)
        })
        $('select[name="status"] option').each(function() {
            if ($(this).val() == loan.status)
                $(this).prop('selected', true)
            else
                $(this).prop('selected', false)
        })

        $('input[name="id"]').val(loan.id)
        $('#phBuku').attr('selected', 'false')
        $('#phUser').attr('selected', 'false')
        $('#exampleModal').modal('show');
    }

    function setInsertModal(){
        $('.modal-title').html('Tambah Peminjaman')
        $('#modalSubmit').attr('name', 'insert')

        $('input[name="judul"]').val('')
        $('input[name="jumlah"]').val('')
        $('textarea[name="sinopsis"]').html('')
        $('form option').each(function()  {
            $(this).prop('selected', false)
        })
        $('#phBuku').attr('selected', true)
        $('#phUser').attr('selected', true)
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