<?php
    session_start();
    if(isset($_POST['update'])){
        include('../db.php');

        $id = $_SESSION['user']['id'];
        $email = $_POST['email'];
        $nama = $_POST['nama'];
        $foto = $_POST['foto'];
        $img = "../img/";
        $namafoto = $id.".jpg";
        $temp = $_FILES['img']['tmp_name'];
        $tujuan = $img.$namafoto;


        $query = mysqli_query($con, "UPDATE users SET email='$email', name='$name', foto='$foto' WHERE id= ". $_SESSION['user']['id']);


        if($query){
            echo
                '<script>
                alert("Profil Berhasil di Edit");
                window.location = "../../views/pages/user/profilePage.php"
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