<?php
    if(isset($_POST['daftar'])){
    
        include('../db.php');
        
        //$id = $_POST['id'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $nama = $_POST['nama'];
        $foto = $_FILES['foto']['name'];
        // $x = explode('.', $foto);
        // $ekstensi = strtolower(end($x));
        // $img = "../img/";
        // $namafoto = $id.".jpg";
        $temp = $_FILES['foto']['tmp_name'];
        // $tujuan = $img.$namafoto;
        

        $query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");
        $users = mysqli_fetch_array($query);
        if(mysqli_num_rows($query) > 0){
            $_SESSION['alert'] = [
                'color' => 'error',
                'msg' => 'Email Harus Unik'
            ];
            echo
                '<script>
                window.location = "../../views/pages/user/regisPage.php"
                </script>';
            die();
        }
        
        if(move_uploaded_file($temp,'../../assets/upload/'.$foto)){
        
            $query = mysqli_query($con,
            "INSERT INTO users(email, password, nama, foto) 
            VALUES
            ('$email', '$password', '$nama', '$foto')")
            or die(mysqli_error($con)); 
        if($query){
            $_SESSION['alert'] = [
                'color' => 'success',
                'msg' => 'Register Success'
            ];
            echo
                '<script>
                window.location = "../../index.php"
                </script>';
        }else{
            $_SESSION['alert'] = [
                'color' => 'error',
                'msg' => 'Register Failes'
            ];
            echo
                '<script>
                window.location = "../../index.php"
                </script>';
            }
        }

       
    }
    else{
        echo
            '<script>
            window.history.back()
            </script>';
    }
?>
