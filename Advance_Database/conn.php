<?php
$servername = "localhost";
$password = "kaell";
$username = "root";
$dbase = "northwind";

$conn = new mysqli($servername, $username, $password, $dbase);

if($conn->connect_error)
{
    die("Connection Failed: ".$conn->connect_error);
}
//echo "Connection Successful!"
?>