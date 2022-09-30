<?php
    session_start();
    if(isset($_POST['profil'])){
        include('../db.php');

        $email = $_POST['email'];
        $nama = $_POST['nama'];
        $foto = $_POST['foto'];


        $query = mysqli_query($con, "UPDATE users SET email='$email', name='$name', foto='$foto' WHERE id= ". $_SESSION['isLogin']['user']);


        if($query){
            echo
                '<script>
                alert("Profil Berhasil di Edit");
                window.location = "../Page/profilePage.php"
                </script>';
        }else{
            echo
                '<script>
                alert("Profil gagal di Edit");
                </script>';
        }
    }else{
        echo
        '<script>
        window.history.back()
        </script>';
    }
?>