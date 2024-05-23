<?php
include "databaseconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$WorkshopID=$_POST['WorkshopID'];
	$UserID=$_POST['UserID'];
	$Rating=$_POST['Rating'];
     $Comment=$_POST['Comment'];
	$sql="INSERT INTO feedback (UserID,WorkshopID,Rating,Comment) VALUES('$UserID','$WorkshopID','$Rating','$Comment')";
		$result=$connection->query($sql);
	if ($result) {
		echo"Inserted Successfully";
		header("location:viewfeedback.php");
		exit();
	}else{
		echo "Inserted fail";
	}

}

?>
