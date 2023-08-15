<?php
$server = "localhost";
$username = "root";
$pass = "";
$dbname = "weather";

$con = mysqli_connect($server,$username,$pass,$dbname);
if(!$con)
{
    echo "connection failed";
}

?>
