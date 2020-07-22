<?php

require 'DBConnection.php';

function Sql($sql, $select = false, $count = false)
{
    $con = conectar();

    mysqli_select_db($con, 'db-loja') or die(mysqli_error($con));

    $res = mysqli_query($con, $sql) or die(mysqli_error($con));

    if ($select)
        if (!$count)
            return mysqli_fetch_assoc($res);
        else
            return mysqli_num_rows($res);

    return $res;
}