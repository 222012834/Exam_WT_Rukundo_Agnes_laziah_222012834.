<?php
if (isset($_GET["WorkshopID"])) {
   $WorkshopID=$_GET["WorkshopID"];
   //call file that contain database connection
include "databaseconnection.php";
$sql="DELETE FROM workshops WHERE WorkshopID=$WorkshopID";
if ($connection->query($sql)) {
    echo "Record deleted successfully";
    header("location:workshops.php");
    exit;
}else{
    echo "Error deleting record: " . $connection->error;
}
$connection->close();
}

?>

 