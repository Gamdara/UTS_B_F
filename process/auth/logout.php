<?php 
    session_start();
    unset($_SESSION['user']);
    $_SESSION['alert'] = [
        'color' => 'success',
        'msg' => 'Berhasil Logout'
    ];
    echo "
        <script>    
        window.location.href = '../../index.php'
        </script>
    "
?>