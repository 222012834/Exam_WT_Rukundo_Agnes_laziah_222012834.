<?php
if (isset($_GET["AttendeeID"])) {
   $AttendeeID=$_GET["AttendeeID"];
   //call file that contain database connection
include "databaseconnection.php";
$sql="DELETE FROM attendees WHERE AttendeeID=$AttendeeID";
if ($connection->query($sql)) {
    echo "Record deleted successfully";
    header("location:attendees.php");
    exit;
}else{
    echo "Error deleting record: " . $connection->error;
}
$connection->close();
}

?>

 