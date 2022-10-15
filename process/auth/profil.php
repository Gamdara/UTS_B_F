<?php
    //session_start();
    if(isset($_POST['update'])){
        include('../db.php');

        $email = $_POST['email'];
        $nama = $_POST['nama'];
        $foto = $_FILES['foto']['name'];
        $temp = $_FILES['foto']['tmp_name'];

        $query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND email <> '". $_SESSION['user']['email'] ."'");
        if(mysqli_num_rows($query) > 0){
            echo
                '<script>
                alert("Email sudah pernah digunakan!");
                window.location = "../../views/pages/user/editProfilePage.php"
                </script>';
            die();
        }
        
        if(empty($foto)){
            $query = mysqli_query($con, 
            "UPDATE users SET email='$email', nama='$nama' 
            WHERE id= ". $_SESSION['user']['id'])
            or die(mysqli_error($con)); 
        }else{
            if(move_uploaded_file($temp,'../../assets/upload/'.$foto)){
            
                $query = mysqli_query($con, 
                "UPDATE users SET email='$email', nama='$nama', foto='$foto' 
                WHERE id= ". $_SESSION['user']['id'])
                or die(mysqli_error($con)); 
            }    
        }

        if($query){
            $query2 = mysqli_query($con, 
                "SELECT * FROM users WHERE id= ". $_SESSION['user']['id'])
                or die(mysqli_error($con)); 
            
            if(mysqli_num_rows($query2) > 0){
                $user = mysqli_fetch_assoc($query2);
                $_SESSION['user'] = $user;
            }
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