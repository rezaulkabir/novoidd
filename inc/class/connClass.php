<?php

class mysqlconnect{

    var $server;

    var $conn_username;

    var $conn_password;

    var $database_name;

    var $connection;

    var $select;

    var $query;



    function connect()

 {

    require "database.inc.php";

    

    $connection = mysql_connect($server,$conn_username,'moynul321');

    $select = mysql_select_db($database_name,$connection);

}

    function query($query)

    {

        $result = mysql_query($query);

        if (!$result) {

            echo 'Could not run query: ' . mysql_error();

            exit;

}

    }

    function end()

    {

        mysql_free_result($connection);

    }

}



?>