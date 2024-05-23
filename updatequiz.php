<?php 
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["QuizID"])) {
        header("location: viewquiz.php");
        exit;
    }

    $QuizID = $_GET["QuizID"];

    $sql = "SELECT * FROM quiz WHERE QuizID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $QuizID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $WorkshopID = $row["WorkshopID"];
        $Question = $row["Question"];
        $Option1 = $row["Option1"];
        $Option2 = $row["Option2"];
        $CorrectAnswer = $row["CorrectAnswer"];
    } else {
        header("location:viewquiz.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $QuizID = $_POST["QuizID"];
    $WorkshopID = $_POST["WorkshopID"];
    $Question = $_POST["Question"];
    $Option1 = $_POST["Option1"];
    $Option2 = $_POST["Option2"];
    $CorrectAnswer = $_POST["CorrectAnswer"];
    if (empty($QuizID) ||  empty($WorkshopID)  ||  empty($Question)  ||  empty($Option1)  ||  empty($Option2) || empty($CorrectAnswer)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE quiz SET WorkshopID='$WorkshopID', Question= '$Question', Option1='$Option1', Option2='$Option2',CorrectAnswer='$CorrectAnswer' WHERE QuizID='$QuizID'";
        if ($connection->query($sql) === TRUE) {
            echo "Information upOption1d successfully";
            header("location:viewquiz.php");
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
    <title>VIRTUAL INTERNET OF THINGS (IOT) WORKSHOP PLATFORM</title>
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
        <h2>VIRTUAL INTERNET OF THINGS (IOT) WORKSHOP PLATFORM</h2>
        <h3 style="color:green;">UPdate QUIZ HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>QuizID</label><br>
                <input type="text" name="QuizID" readonly  value="<?php echo $QuizID; ?>"><br>
                <label>WorkshopID</label><br>
                <input type="text" name="WorkshopID"  value="<?php echo $WorkshopID; ?>"><br> 
                <label>Question</label><br>
                <input type="Question" name="Question" value="<?php echo $Question; ?>" ><br> 
                <label>Option1</label><br>
                <input type="text" name="Option1" value="<?php echo $Option1; ?>" ><br>
                 <label>Option2</label><br>
                <input type="text" name="Option2" value="<?php echo $Option2; ?>" ><br>
                 <label>CorrectAnswer</label><br>
                <input type="text" name="CorrectAnswer" value="<?php echo $Option2; ?>" ><br>

                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color:blue; text-align: center; margin-top:40px;"><marquee> &copy; copy right&reg; LAZIAH_222012834_CBE_BIT_Year2_Group_2.</marquee> </p>
    </footer>
</body>
</html>


