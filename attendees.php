<?php
include "databaseconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$UserID=$_POST['UserID'];
	$WorkshopID=$_POST['WorkshopID'];
	$RegistrationDate=$_POST['RegistrationDate'];
	$InstructorID=$_POST['InstructorID'];
	$MaxParticipants=$_POST['MaxParticipants'];
	$sql="INSERT INTO attendees (UserID,WorkshopID,RegistrationDate) VALUES('$UserID','$WorkshopID','$RegistrationDate')";
		$result=$connection->query($sql);
	if ($result) {
		echo"Inserted Successfully";
		header("location:viewattendees.php");
		exit();
	}else{
		echo "Inserted fail";
	}

}

?>
