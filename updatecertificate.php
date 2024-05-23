<?php 
include "databaseconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["CertificateID"])) {
        header("Location: viewcertificate.php");
        exit;
    }

    $CertificateID = $_GET["CertificateID"];

    $sql = "SELECT * FROM certificate WHERE CertificateID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $CertificateID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $AttendeeID = $row["AttendeeID"];
        $WorkshopID = $row["WorkshopID"];
        $IssueDate = $row["IssueDate"];
    } else {
        header("Location: viewcertificate.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $CertificateID = $_POST["CertificateID"];
    $AttendeeID = $_POST["AttendeeID"];
    $WorkshopID = $_POST["WorkshopID"];
    $IssueDate = $_POST["IssueDate"];

    if (empty($CertificateID) || empty($AttendeeID) || empty($WorkshopID) || empty($IssueDate)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE certificate SET AttendeeID = ?, WorkshopID = ?, IssueDate = ? WHERE CertificateID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iisi", $AttendeeID, $WorkshopID, $IssueDate, $CertificateID);

        if ($stmt->execute() === TRUE) {
            echo "Information updated successfully";
            header("Location: viewcertificate.php");
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
    <title>VIRTUAL INTERNET OF THINGS(IOT) WORKSHOPS PLATFORM</title>
    <script>
        function confirmUpdate() {
            return confirm('Do you want to update this record');
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
        <h2>VIRTUAL INTERNET OF THINGS(IOT) WORKSHOPS PLATFORM</h2>
        <h3 style="color: green;">UPDATE CERTIFICATE HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>CertificateID</label><br>
                <input type="text" name="CertificateID" readonly value="<?php echo $CertificateID; ?>"><br>
                <label>AttendeeID</label><br>
                <input type="text" name="AttendeeID" value="<?php echo $AttendeeID; ?>"><br> 
                <label>WorkshopID</label><br>
                <input type="text" name="WorkshopID" value="<?php echo $WorkshopID; ?>"><br> 
                <label>IssueDate</label><br>
                <input type="text" name="IssueDate" value="<?php echo $IssueDate; ?>"><br> 
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color: blue; text-align: center; margin-top: 40px;">
            <marquee> &copy; copyright&reg; LAZIAH_222012834_CBE_BIT_Year2_Group_2.</marquee>
        </p>
    </footer>
</body>
</html>
