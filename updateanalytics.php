<?php 
include "databaseconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["AnalyticsID"])) {
        header("location: viewanalytics.php");
        exit;
    }

    $AnalyticsID = $_GET["AnalyticsID"];

    $sql = "SELECT * FROM analytics WHERE AnalyticsID = $AnalyticsID";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $WorkshopID = $row["WorkshopID"];
        $AttendeeID = $row["AttendeeID"];
        $QuizID = $row["QuizID"];
        $Score = $row["Score"];
    } else {
        header("location:viewanalytics.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $AnalyticsID = $_POST["AnalyticsID"];
    $WorkshopID = $_POST["WorkshopID"];
    $AttendeeID = $_POST["AttendeeID"];
    $QuizID = $_POST["QuizID"];
    $Score = $_POST['Score'];

    if (empty($AnalyticsID) ||  empty($WorkshopID) || empty($AttendeeID) || empty($QuizID) || empty($Score)){
        echo "All fields are required!";
    } else {
        $sql = "UPDATE analytics SET WorkshopID='$WorkshopID', AttendeeID= '$AttendeeID', QuizID='$QuizID', Score='$Score' WHERE AnalyticsID='$AnalyticsID'";
    
        if ($connection->query($sql) === TRUE) {
            echo "Information updated successfully";
            header("location:viewanalytics.php");
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
        <h2>VIRTUAL INTERNET OF THINGS (IOT) WORKSHOPS PLATFORM</h2>
        <h3 style="color:green;">UPDATE ANALYTICS HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>AnalyticsID</label><br>
                <input type="text" name="AnalyticsID" readonly  value="<?php echo $AnalyticsID; ?>"><br>
                <label>WorkshopID</label><br>
                <input type="text" name="WorkshopID"  value="<?php echo $WorkshopID; ?>"><br> 
                <label>AttendeeID</label><br>
                <input type="text" name="AttendeeID" value="<?php echo $AttendeeID; ?>" ><br> 
                <label>QuizID</label><br>
                <input type="text" name="QuizID" value="<?php echo $QuizID; ?>" ><br>
                <label>Score</label><br>
                <input type="text" name="Score"  value="<?php echo $Score; ?>"><br>  
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color:blue; text-align: center; margin-top:40px;"><marquee> &copy; copy right&reg; LAZIAH_222012834_CBE_BIT_Year2_Group_2.</marquee> </p>
    </footer>
</body>
</html>


 
 
 
 