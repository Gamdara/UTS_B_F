<?php 
    // include ("../process/db.php");

    function url(){
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        
        // return $protocol . "://" . $_SERVER['HTTP_HOST'] .dirname($_SERVER["REQUEST_URI"],count(explode('/',$_SERVER["REQUEST_URI"])) - 2);
        return $protocol . "://" .$_SERVER['HTTP_HOST'] . "/" . "TUBES_PW_F";
    }

    function execute_query($query){
        global $con;
        return mysqli_query($con, $query);
    }

    function select_foreign($transaksi,$buku,$user){
        return mysqli_fetch_all(execute_query("select * from $transaksi JOIN $buku ON $transaksi.id_buku = $buku.id WHERE $user = $transaksi.id_user" ), MYSQLI_ASSOC);
    }
     
    function verify_files($images){
        foreach($images as $col => $img){
            if($img['size'] == 0) return [ "status" => "empty", "msg" => ""];
            
            if($img["error"]) return [ "status" => false, "msg" => $img["error"]];

            $allowed_ext = array("jpg" => "image/jpg",
                                "jpeg" => "image/jpeg",
                                "png" => "image/png");
            $file_name = $img["name"];
            $file_type = $img["type"];
            $file_size = $img["size"];
            
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        
            if (!array_key_exists($ext, $allowed_ext)) {
                return [ "status" => false, "msg" => "Format gambar tidak valid"];
            }    
                    
            $maxsize = 2 * 1024 * 1024;
                
            if ($file_size > $maxsize) 
                return [ "status" => false, "msg" => "Gambar melebihi batas ukuran"];
        }
        return [ "status" => true, "msg" => ""];
    }

    function upload_file($data, $images){
        foreach($images as $col => $img){
            $newname = uniqid() . "." . pathinfo($img["name"], PATHINFO_EXTENSION);
            $aa = move_uploaded_file($img["tmp_name"], dirname(__FILE__, 2). "\\assets\\upload\\".$newname);
            $data[$col] = $newname;
        }

        return $data;
    }

    function select_all($table, $columns = "*"){
        return mysqli_fetch_all(execute_query("select $columns from $table"), MYSQLI_ASSOC);
    }

    function select_all_join($table, $joins, $columns = "*"){
        $on = "";
        foreach($joins as $tabl => $conn){
            $on .= " join $tabl on $conn ";
        }
        return mysqli_fetch_all(execute_query("select $columns from $table $on"), MYSQLI_ASSOC);
    }

    function select($table, $cond , $columns = "*"){
        return mysqli_fetch_all(execute_query("select $columns from $table where $cond"), MYSQLI_ASSOC);
    }

    function select_join($table, $joins, $cond, $columns = "*"){
        $on = "";
        foreach($joins as $tabl => $conn){
            $on .= " join $tabl on $conn ";
        }
        return mysqli_fetch_all(execute_query("select $colums from $table $on where $cond"), MYSQLI_ASSOC);
    }
    

    function insert($table, $data){
        $column = "";
        $value = "";
        
        foreach($data as $key => $val){
            $column .=  "$key,";
            $value .=  "'$val',";
        }

        $column = substr($column , 0, -1);
        $value = substr($value , 0, -1);

        return execute_query("insert into $table($column) values($value)");
    }

    function update($table, $data, $cond){
        $set = "";
        
        foreach($data as $key => $value){
            $set .= "$key='$value',";
        }

        $set = substr($set , 0, -1);
        return execute_query("update $table set $set where $cond");
    }

    function delete($table, $cond){
        return execute_query("delete from $table where $cond");
    }

    
?>