<?php
    if(isset($_POST['register'])){
    
        include('../db.php');
    
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $name = $_POST['name'];
        $phonenum = $_POST['phonenum'];
        $membership = $_POST['membership'];

        $query = mysqli_query($con, "select * from users where phonenum = '$phonenum' or email = '$email'");
        $users = mysqli_fetch_array($query);
        if(mysqli_num_rows($query) > 0){
            echo
                '<script>
                alert("Email dan Nomor telepon harus unik!");
                window.location = "../page/registerPage.php"
                </script>';
            die();
        }
        
        $query = mysqli_query($con,
        "INSERT INTO users(email, password, name, phonenum, membership) 
        VALUES
        ('$email', '$password', '$name', '$phonenum', '$membership')")
        or die(mysqli_error($con)); 
        if($query){
        echo
            '<script>
            alert("Register Success"); 
            window.location = "../index.php"
            </script>';
        }else{
            echo
                '<script>
                alert("Register Failed");
                </script>';
        }
    }
    else{
        echo
            '<script>
            window.history.back()
            </script>';
    }
?>
