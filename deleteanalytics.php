<?php
if (isset($_GET["AnalyticsID"])) {
   $AnalyticsID=$_GET["AnalyticsID"];
   //call file that contain database connection
include "databaseconnection.php";
$sql="DELETE FROM analytics WHERE AnalyticsID=$AnalyticsID";
if ($connection->query($sql)) {
    echo "Record deleted successfully";
    header("location:analytics.php");
    exit;
}else{
    echo "Error deleting record: " . $connection->error;
}
$connection->close();
}

?>


 