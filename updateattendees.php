<?php 
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["AttendeeID"])) {
        header("Location: viewattendees.php");
        exit;
    }

    $AttendeeID = $_GET["AttendeeID"];

    // Prepared statement to prevent SQL injection
    $sql = "SELECT * FROM attendees WHERE AttendeeID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $AttendeeID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row["UserID"];
        $WorkshopID = $row["WorkshopID"];
        $RegistrationDate = $row["RegistrationDate"];
    } else {
        header("Location: viewattendees.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $AttendeeID = $_POST["AttendeeID"];
    $UserID = $_POST["UserID"];
    $WorkshopID = $_POST["WorkshopID"];
    $RegistrationDate = $_POST["RegistrationDate"];

    if (empty($AttendeeID) || empty($UserID) || empty($WorkshopID) || empty($RegistrationDate)) {
        echo "All fields are required!";
    } else {
        // Prepared statement to prevent SQL injection
        $sql = "UPDATE attendees SET UserID = ?, WorkshopID = ?, RegistrationDate = ? WHERE AttendeeID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iisi", $UserID, $WorkshopID, $RegistrationDate, $AttendeeID);

        if ($stmt->execute() === TRUE) {
            echo "Information updated successfully";
            header("Location: viewattendees.php");
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
        <h3 style="color:green;">UPDATE ATTENDANCE HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>AttendeeID</label><br>
                <input type="text" name="AttendeeID" readonly value="<?php echo $AttendeeID; ?>"><br>
                <label>UserID</label><br>
                <input type="text" name="UserID" value="<?php echo $UserID; ?>"><br>
                <label>WorkshopID</label><br>
                <input type="text" name="WorkshopID" value="<?php echo $WorkshopID; ?>"><br>
                <label>RegistrationDate</label><br>
                <input type="text" name="RegistrationDate" value="<?php echo $RegistrationDate; ?>"><br>
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
