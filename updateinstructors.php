<?php 
include "databaseconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["InstructorID"])) {
        header("location: viewinstructors.php");
        exit;
    }

    $InstructorID = $_GET["InstructorID"];

    $sql = "SELECT * FROM instructors WHERE InstructorID = $InstructorID";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row["UserID"];
        $Bio= $row["Bio"];
        $Specialization = $row["Specialization"];
    } else {
        header("location:viewinstructors.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $InstructorID = $_POST["InstructorID"];
    $UserID = $_POST["UserID"];
    $Bio = $_POST["Bio"];
    $Specialization = $_POST["Specialization"];

    if (empty($InstructorID) ||  empty($UserID) || empty($Bio) || empty($Specialization)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE instructors SET UserID='$UserID', Bio= '$Bio', Specialization='$Specialization' WHERE InstructorID='$InstructorID'";
    
        if ($connection->query($sql) === TRUE) {
            echo "Information updated successfully";
            header("location:viewinstructors.php");
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
    <title>virtual internet of things workshops platform</title>
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
        <h2>virtual internet of things workshops platform</h2>
        <h3 style="color:green;">UPDATE INSTRUCTORS HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>InstructorID</label><br>
                <input type="text" name="InstructorID" readonly  value="<?php echo $InstructorID; ?>"><br>
                <label>UserID</label><br>
                <input type="text" name="UserID"  value="<?php echo $UserID; ?>"><br> 
                <label>Bio</label><br>
                <input type="text" name="Bio" value="<?php echo $Bio; ?>" ><br> 
                <label>Unit Price</label><br>
                <input type="text" name="Specialization" value="<?php echo $Specialization; ?>" ><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color:blue; text-align: center; margin-top:40px;"><marquee> &copy; copy right&reg; LAZIAH_222012834_CBE_BIT_Year2_Group_2.</marquee> </p>
    </footer>
</body>
</html>

 