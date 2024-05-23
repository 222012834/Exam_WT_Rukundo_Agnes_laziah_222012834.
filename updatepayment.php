<?php 
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["PaymentID"])) {
        header("Location: viewpayment.php");
        exit;
    }

    $PaymentID = $_GET["PaymentID"];

    // Prepared statement to prevent SQL injection
    $sql = "SELECT * FROM payment WHERE PaymentID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $PaymentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row["UserID"];
        $WorkshopID = $row["WorkshopID"];
        $Amount = $row["Amount"];
        $PaymentDate = $row["PaymentDate"];
    } else {
        header("Location: viewpayment.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $PaymentID = $_POST["PaymentID"];
    $UserID = $_POST["UserID"];
    $WorkshopID = $_POST["WorkshopID"];
    $Amount = $_POST["Amount"];
    $PaymentDate = $_POST["PaymentDate"];

    if (empty($PaymentID) || empty($UserID) || empty($WorkshopID) || empty($Amount) || empty($PaymentDate)) {
        echo "All fields are required!";
    } else {
        // Prepared statement to prevent SQL injection
        $sql = "UPDATE payment SET UserID = ?, WorkshopID = ?, Amount = ?, PaymentDate = ? WHERE PaymentID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iidsi", $UserID, $WorkshopID, $Amount, $PaymentDate, $PaymentID);

        if ($stmt->execute() === TRUE) {
            echo "Information updated successfully";
            header("Location: viewpayment.php");
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
        <h3 style="color:green;">UPDATE PAYMENT HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>PaymentID</label><br>
                <input type="text" name="PaymentID" readonly value="<?php echo $PaymentID; ?>"><br>
                <label>UserID</label><br>
                <input type="text" name="UserID" value="<?php echo $UserID; ?>"><br> 
                <label>WorkshopID</label><br>
                <input type="text" name="WorkshopID" value="<?php echo $WorkshopID; ?>"><br> 
                <label>Amount</label><br>
                <input type="text" name="Amount" value="<?php echo $Amount; ?>"><br> 
                <label>PaymentDate</label><br>
                <input type="text" name="PaymentDate" value="<?php echo $PaymentDate; ?>"><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color:blue; text-align: center; margin-top:40px;">
            <marquee>&copy; copyright&reg; LAZIAH_222012834_CBE_BIT_Year2_Group_2.</marquee>
        </p>
    </footer>
</body>
</html>
