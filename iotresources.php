<?php
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $WorkshopID = $_POST['WorkshopID'];
    $ResourceType = $_POST['ResourceType'];
    $ResourceName = $_POST['ResourceName'];
    $ResourceURL = $_POST['ResourceURL'];

    // Prepare and bind
    $stmt = $connection->prepare("INSERT INTO iotresources (WorkshopID, ResourceType, ResourceName, ResourceURL) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $WorkshopID, $ResourceType, $ResourceName, $ResourceURL);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Inserted Successfully";
        header("Location: viewiotresources.php");
        exit();
    } else {
        echo "Insert failed: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$connection->close();
?>
