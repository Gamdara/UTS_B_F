<?php
    //session_start();
    if(isset($_POST['updatePass'])){
        include('../db.php');
        include('../functions.php');

        $passLama = $_POST['passwordLama'];
        $passBaru = $_POST['passwordBaru'];
        $konfPassBaru = $_POST['konfPasswordBaru'];

        $query = mysqli_query($con, 
                        "SELECT * FROM users WHERE id= ". $_SESSION['user']['id'])
                        or die(mysqli_error($con)); 

        $user = mysqli_fetch_assoc($query);
        if($query){
            if(password_verify($passLama, $user['password'])){
                if($passBaru == $konfPassBaru){
                    $password = password_hash($passBaru, PASSWORD_DEFAULT);
                    $query2 = mysqli_query($con, 
                        "UPDATE users SET password='$password'
                        WHERE id= ". $_SESSION['user']['id'])
                        or die(mysqli_error($con)); 
                    
                    $_SESSION['user']['password']=$password;

                    $_SESSION['alert'] = [
                        'color' => 'success',
                        'msg' => 'Password Berhasil di Update'
                    ];
                    echo
                        '<script>
                        window.location = "../../views/pages/user/editProfilePage.php"
                        </script>';
                }else {
                    $_SESSION['alert'] = [
                        'color' => 'error',
                        'msg' => 'Password Baru Invalid!'
                    ];
                    echo
                        '<script>
                        window.location = "../../views/pages/user/editProfilePage.php"
                        </script>';
                }
            }else {
                $_SESSION['alert'] = [
                    'color' => 'error',
                    'msg' => 'Password Lama Invalid!'
                ];
                echo
                    '<script>
                    window.location = "../../views/pages/user/editProfilePage.php"
                    </script>';
            }            
        }else{
            $_SESSION['alert'] = [
                'color' => 'error',
                'msg' => 'Gagal Edit!'
            ];
            echo
                '<script>
                window.location = "../../views/pages/user/editProfilePage.php"
                </script>';
        }

    }else{
        echo
        '<script>
        window.history.back()
        </script>';
    }

?>