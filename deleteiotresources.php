<?php
if (isset($_GET["ResourceID"])) {
    $ResourceID = $_GET["ResourceID"];
    // Call file that contains database connection
    include "databaseconnection.php";
    $sql = "DELETE FROM iotresources WHERE ResourceID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $ResourceID);
    
    if ($stmt->execute()) {
        echo "Record deleted successfully";
        header("Location: iotresources.php");
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
    $connection->close();
}
?>


 