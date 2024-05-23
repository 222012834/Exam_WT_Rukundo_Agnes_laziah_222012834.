<?php
if (isset($_GET["PaymentID"])) { // Remove extra space in the GET parameter
    $PaymentID = $_GET["PaymentID"]; // Remove extra spaces around the variable

    // Include the file that contains the database connection
    include "databaseconnection.php";

    // Prepared statement to prevent SQL injection
    $sql = "DELETE FROM payment WHERE PaymentID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $PaymentID);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
        // Redirect to quiz.php after successful deletion
        header("Location: payment.php");
        exit;
    } else {
        echo "Error deleting record: " . $connection->error;
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
}
?>
