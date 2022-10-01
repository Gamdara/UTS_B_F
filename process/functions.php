<?php 
    // include ("../process/db.php");

    function execute_query($query){
        global $con;
        return mysqli_query($con, $query);
    }

    function select_foreign($transaksi,$buku,$user){
        return mysqli_fetch_all(execute_query("select * from $transaksi JOIN $buku ON $transaksi.id_buku = $buku.id WHERE $user = $transaksi.id_user" ), MYSQLI_ASSOC);
    }

    function select_all($table){
        return mysqli_fetch_all(execute_query("select * from $table"), MYSQLI_ASSOC);
    }

    function select($table, $cond){
        return mysqli_fetch_all(execute_query("select * from $table where $cond"), MYSQLI_ASSOC);
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