<?php
    if(isset($_POST['login'])){
        include('../db.php'); 
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'") or
        die(mysqli_error($con));
        
        if(mysqli_num_rows($query) == 0){
            echo
            '<script>
            alert("Email not found!"); window.location = "../page/loginPage.php"
            </script>';
        }else{
            $user = mysqli_fetch_assoc($query);
            if(password_verify($password, $user['password'])){
        
                session_start();
        
                $_SESSION['isLogin'] = true;
                $_SESSION['user'] = $user;
                echo
                '<script>
                alert("Login Success"); window.location = "../page/dashboardPage.php"
                </script>';
            }else {
                echo
                '<script>
                alert("Email or Password Invalid");
                window.location = "../page/loginPage.php"
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