<?php
if (isset($_GET["InstructorID"])) {
   $InstructorID=$_GET["InstructorID"];
   //call file that contain database connection
include "databaseconnection.php";
$sql="DELETE FROM instructors WHERE InstructorID=$InstructorID";
if ($connection->query($sql)) {
    echo "Record deleted successfully";
    header("location:instructors.php");
    exit;
}else{
    echo "Error deleting record: " . $connection->error;
}
$connection->close();
}

?>

 