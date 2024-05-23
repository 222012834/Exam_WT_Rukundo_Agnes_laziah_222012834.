<?php 
include "databaseconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["WorkshopID"])) {
        header("location: viewworkshops.php");
        exit;
    }

    $WorkshopID = $_GET["WorkshopID"];

    $sql = "SELECT * FROM workshops WHERE WorkshopID = $WorkshopID";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $Title = $row["Title"];
        $Description = $row["Description"];
        $Date = $row["Date"];
        $InstructorID = $row["InstructorID"];
        $MaxParticipants = $row["MaxParticipants"];
    } else {
        header("location:viewworkshops.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $WorkshopID = $_POST["WorkshopID"];
    $Title = $_POST["Title"];
    $Description = $_POST["Description"];
    $Date = $_POST["Date"];
    $InstructorID = $_POST['InstructorID'];
    $MaxParticipants = $_POST['MaxParticipants'];

    if (empty($WorkshopID) ||  empty($Title) || empty($Description) || empty($Date) || empty($InstructorID) || empty($MaxParticipants)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE workshops SET Title='$Title', Description= '$Description', Date='$Date', InstructorID='$InstructorID', MaxParticipants='$MaxParticipants' WHERE WorkshopID='$WorkshopID'";
    
        if ($connection->query($sql) === TRUE) {
            echo "Information updated successfully";
            header("location:viewworkshops.php");
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
    <title>VIRTUAL INTERNET OF THINGS (IOT)WORKSHOPS PLATFORM</title>
        <script >
        function confirmUpdate(){
        return confirm('Do you want to update this record');
               }

    </script>
    <style>
        h2 {
            font-family: Castellar;
            color: darkblue;
        }
        label {
            font-family: elephant;
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
        <h2>VIRTUAL INTERNET OF THINGS (IOT)WORKSHOPS PLATFORM</h2>
        <h3 style="color:green;">UPDATE WORKSHOPS HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>WorkshopID</label><br>
                <input type="text" name="WorkshopID" readonly  value="<?php echo $WorkshopID; ?>"><br>
                <label>Title</label><br>
                <input type="text" name="Title"  value="<?php echo $Title; ?>"><br> 
                <label>Description</label><br>
                <input type="text" name="Description" value="<?php echo $Description; ?>" ><br> 
                <label>Date</label><br>
                <input type="text" name="Date" value="<?php echo $Date; ?>" ><br>
                <label>InstructorID</label><br>
                <input type="text" name="InstructorID"  value="<?php echo $InstructorID; ?>"><br>  
                <label>Description</label><br>
                <textarea name="MaxParticipants" ><?php echo $MaxParticipants; ?></textarea><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color:blue; text-align: center; margin-top:40px;"><marquee> &copy; copy right&reg; LAZIAH_222012834_CBE_BIT_Year2_Group_2.</marquee> </p>
    </footer>
</body>
</html>


 