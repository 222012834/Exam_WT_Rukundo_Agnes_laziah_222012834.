<?php
include "databaseconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$WorkshopID=$_POST['WorkshopID'];
	$AttendeeID=$_POST['AttendeeID'];
	$QuizID=$_POST['QuizID'];
	$Score=$_POST['Score'];
	$sql="INSERT INTO analytics (WorkshopID,AttendeeID,QuizID,Score) VALUES('$WorkshopID','$AttendeeID','$QuizID','$Score')";
		$result=$connection->query($sql);
	if ($result) {
		echo"Inserted Successfully";
		header("location:viewanalytics.php");
		exit();
	}else{
		echo "Inserted fail";
	}

}

?>




