<?php 
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["ResourceID"])) {
        header("Location: viewiotresources.php");
        exit;
    }

    $ResourceID = $_GET["ResourceID"];
    
    $sql = "SELECT * FROM iotresources WHERE ResourceID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $ResourceID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $WorkshopID = $row["WorkshopID"];
        $ResourceType = $row["ResourceType"];
        $ResourceName = $row["ResourceName"];
        $ResourceURL = $row["ResourceURL"];
    } else {
        header("Location: viewiotresources.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ResourceID = $_POST["ResourceID"];
    $WorkshopID = $_POST["WorkshopID"];
    $ResourceType = $_POST["ResourceType"];
    $ResourceName = $_POST['ResourceName'];
    $ResourceURL = $_POST['ResourceURL'];

    if (empty($ResourceID) ||  empty($WorkshopID) || empty($ResourceType) || empty($ResourceName) || empty($ResourceURL)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE iotresources SET WorkshopID=?, ResourceType=?, ResourceName=?, ResourceURL=? WHERE ResourceID=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sissi", $WorkshopID, $ResourceType, $ResourceName, $ResourceURL, $ResourceID);
        
        if ($stmt->execute() === TRUE) {
            echo "Information updated successfully";
            header("Location: viewiotresources.php");
            exit;
        } else {
            echo "Error updating record: " . $stmt->error;
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
        <h3 style="color:green;">UPDATE IOT RESOURCES HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>ResourceID</label><br>
                <input type="text" name="ResourceID" readonly value="<?php echo htmlspecialchars($ResourceID); ?>"><br> 
                <label>WorkshopID</label><br>
                <input type="text" name="WorkshopID" value="<?php echo htmlspecialchars($WorkshopID); ?>"><br> 
                <label>ResourceType</label><br>
                <input type="text" name="ResourceType" value="<?php echo htmlspecialchars($ResourceType); ?>"><br>
                <label>ResourceName</label><br>
                <input type="text" name="ResourceName" value="<?php echo htmlspecialchars($ResourceName); ?>"><br>  
                <label>ResourceURL</label><br>
                <input type="text" name="ResourceURL" value="<?php echo htmlspecialchars($ResourceURL); ?>"><br>
                
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color:blue; text-align: center; margin-top:40px;"><marquee>&copy; LAZIAH_222012834_CBE_BIT_Year2_Group_2.</marquee></p>
    </footer>
</body>
</html>
