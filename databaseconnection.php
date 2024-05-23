<?php  
$servername="localhost";
$username="222012834";
$password="222012834";
$databasename="virtual_internet of things (iot) workshops_ platform";
$connection=new mysqli($servername,$username,$password,$databasename);
if ($connection->connect_error) {
    die("connection failed.".$connection->connect_error);
}
?>