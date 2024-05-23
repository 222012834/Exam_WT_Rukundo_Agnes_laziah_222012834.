<?php
include "databaseconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$WorkshopID=$_POST['WorkshopID'];
	$Question=$_POST['Question'];
	$Option1=$_POST['Option1'];
	$Option2=$_POST['Option2'];
	$sql="INSERT INTO quiz (WorkshopID,Question,Option1,Option2,CorrectAnswer) VALUES('$WorkshopID','$Question','$Option1','$Option2','$CorrectAnswer')";
		$result=$connection->query($sql);
	if ($result) {
		echo"Inserted Successfully";
		header("location:viewquiz.php");
		exit();
	}else{
		echo "Inserted fail";
	}

}

?>