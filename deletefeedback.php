<?php
if (isset($_GET["FeedbackID"])) {
    $FeedbackID = $_GET["FeedbackID"];

    // Include the file that contains the database connection
    include "databaseconnection.php";

    // Prepared statement to prevent SQL injection
    $sql = "DELETE FROM feedback WHERE FeedbackID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $FeedbackID);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
        // Redirect to feedback.php after successful deletion
        header("Location: feedback.php");
        exit;
    } else {
        echo "Error deleting record: " . $connection->error;
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
}
?>
