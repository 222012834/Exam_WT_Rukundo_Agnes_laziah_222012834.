<?php
include "databaseconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$AttendeeID=$_POST['AttendeeID'];
	$WorkshopID=$_POST['WorkshopID'];
	$IssueDate=$_POST['IssueDate'];
	$sql="INSERT INTO certificate (AttendeeID,WorkshopID,IssueDate) VALUES('$AttendeeID','$WorkshopID','$IssueDate')";
		$result=$connection->query($sql);
	if ($result) {
		echo"Inserted Successfully";
		header("location:viewcertificate.php");
		exit();
	}else{
		echo "Inserted fail";
	}

}

?>
