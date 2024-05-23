<?php 
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["FeedbackID"])) {
        header("Location: viewfeedback.php");
        exit;
    }

    $FeedbackID = $_GET["FeedbackID"];

    // Prepared statement to prevent SQL injection
    $sql = "SELECT * FROM feedback WHERE FeedbackID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $FeedbackID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $WorkshopID = $row["WorkshopID"];
        $UserID = $row["UserID"];
        $Rating = $row["Rating"];
        $Comment = $row["Comment"];
    } else {
        header("Location: viewfeedback.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $FeedbackID = $_POST["FeedbackID"];
    $WorkshopID = $_POST["WorkshopID"];
    $UserID = $_POST["UserID"];
    $Rating = $_POST["Rating"];
    $Comment = $_POST["Comment"];

    if (empty($FeedbackID) || empty($WorkshopID) || empty($UserID) || empty($Rating) || empty($Comment)) {
        echo "All fields are required!";
    } else {
        // Prepared statement to prevent SQL injection
        $sql = "UPDATE feedback SET WorkshopID = ?, UserID = ?, Rating = ?, Comment = ? WHERE FeedbackID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iissi", $WorkshopID, $UserID, $Rating, $Comment, $FeedbackID);

        if ($stmt->execute() === TRUE) {
            echo "Information updated successfully";
            header("Location: viewfeedback.php");
            exit;
        } else {
            echo "Error updating record: " . $connection->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VIRTUAL INTERNET OF THINGS (IOT) WORKSHOPS PLATFORM</title>
    <script>
        function confirmUpdate() {
            return confirm('Do you want to update this record?');
        }
    </script>
    <style>
        h2 {
            font-family: Castellar;
            color: darkblue;
        }
        label {
            font-family: Elephant;
            font-size: 20px;
        }
        .sb {
            font-family: Georgia;
            padding: 10px;
            border-color: blue;
            background-color: skyblue;
            width: 200px;
            margin-top: 5px;
            border-radius: 12px;
            font-weight: bold;
            color: blue;
        }
        .input {
            width: 350px;
            height: 35px;
            border-radius: 12px;
            border-color: green;
        }
    </style>
</head>
<body>
    <center>
        <h2>VIRTUAL INTERNET OF THINGS (IOT) WORKSHOPS PLATFORM</h2>
        <h3 style="color:green;">UPDATE FEEDBACK HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>FeedbackID</label><br>
                <input type="text" name="FeedbackID" readonly value="<?php echo $FeedbackID; ?>"><br>
                <label>WorkshopID</label><br>
                <input type="text" name="WorkshopID" value="<?php echo $WorkshopID; ?>"><br>
                <label>UserID</label><br>
                <input type="text" name="UserID" value="<?php echo $UserID; ?>"><br>
                <label>Rating</label><br>
                <input type="text" name="Rating" value="<?php echo $Rating; ?>"><br>
                <label>Comment</label><br>
                <input type="text" name="Comment" value="<?php echo $Comment; ?>"><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color:blue; text-align: center; margin-top:40px;">
            <marquee> &copy; copyright&reg; LAZIAH_222012834_CBE_BIT_Year2_Group_2.</marquee>
        </p>
    </footer>
</body>
</html>

