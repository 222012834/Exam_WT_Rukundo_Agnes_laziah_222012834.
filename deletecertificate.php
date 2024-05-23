<?php
if (isset($_GET["CertificateID"])) {
   $CertificateID=$_GET["CertificateID"];
   //call file that contain database connection
include "databaseconnection.php";
$sql="DELETE FROM certificate WHERE CertificateID=$CertificateID";
if ($connection->query($sql)) {
    echo "Record deleted successfully";
    header("location:certificate.php");
    exit;
}else{
    echo "Error deleting record: " . $connection->error;
}
$connection->close();
}

?>

 