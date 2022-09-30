<?php 
    // include ("../process/db.php");

    function execute_query($query){
        global $con;
        return mysqli_query($con, $query);
    }

    function select_all($table){
        return execute_query("select * from $table");
    }

    function select($table, $cond){
        return execute_query("select * from $table where $cond");
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