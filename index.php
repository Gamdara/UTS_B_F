<?php 
    include ("process/db.php");
    include ("process/functions.php");
    
    
    if(!empty($_POST)){
        // insert ke table series
        $ins = insert("series", $_POST);
        // update ke table series
        $upt = update("series", $_POST, ['id', '=', $_GET['id']]);
    }
    if(!empty($_GET)){
        // delete dari tabel series
        $del = delete("series", ['id', '=', $_GET['id']]);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="?id=1" method="post">
        <input type="text" name="username" id="">
        <input type="text" name="password" id="">
        <button>kirim</button>
    </form>
    <a href="?id=1"><button>Hapus</button></a>
</body>
</html>