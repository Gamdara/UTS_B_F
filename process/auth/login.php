<?php
    if(isset($_POST['submit'])){
        include('../db.php'); 
        include ("../functions.php");
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'") or
        die(mysqli_error($con));
        
        if(mysqli_num_rows($query) == 0){
            $_SESSION['alert'] = [
                'color' => 'error',
                'msg' => 'Email not found!'
            ];
            echo
            '<script>
            window.location = "../../views/pages/user/loginPage.php"
            </script>';
        }else{
            $user = mysqli_fetch_assoc($query);
            if(password_verify($password, $user['password'])){
        
                $_SESSION['isLogin'] = true;
                $_SESSION['user'] = $user;
                $_SESSION['alert'] = [
                    'color' => 'success',
                    'msg' => 'Login Success'
                ];
                echo
                '<script>
                window.location = "../../views/pages/admin/dashboard.php"
                </script>';
            }else {
                $_SESSION['alert'] = [
                    'color' => 'error',
                    'msg' => 'Email or Password Invalid'
                ];
                echo
                '<script>
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