<?php
if (isset($_GET["QuizID"])) { // Remove extra space in the GET parameter
    $QuizID = $_GET["QuizID"]; // Remove extra spaces around the variable

    // Include the file that contains the database connection
    include "databaseconnection.php";

    // Prepared statement to prevent SQL injection
    $sql = "DELETE FROM quiz WHERE QuizID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $QuizID);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
        // Redirect to quiz.php after successful deletion
        header("Location: quiz.php");
        exit;
    } else {
        echo "Error deleting record: " . $connection->error;
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
}
?>
