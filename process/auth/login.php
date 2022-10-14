<?php
    if(isset($_POST['submit'])){
        include('../db.php'); 
        include ("../functions.php");
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'") or
        die(mysqli_error($con));
        
        if(mysqli_num_rows($query) == 0){
            echo
            '<script>
            alert("Email not found!"); window.location = "../../views/pages/user/loginPage.php"
            </script>';
        }else{
            $user = mysqli_fetch_assoc($query);
            if(password_verify($password, $user['password'])){
        
                $_SESSION['isLogin'] = true;
                $_SESSION['user'] = $user;
                echo
                '<script>
                alert("Login Success"); window.location = "../../views/pages/admin/dashboard.php"
                </script>';
            }else {
                echo
                '<script>
                alert("Email or Password Invalid");
                window.location = "../../views/pages/user/loginPage.php"
                </script>';
            }
        }
    }else{
        echo
        '<script>
        window.history.back()
        </script>';
    }
?>