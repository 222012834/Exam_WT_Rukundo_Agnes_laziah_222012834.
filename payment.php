<?php
include "databaseconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$WorkshopID=$_POST['WorkshopID'];
	$Amount=$_POST['Amount'];
	$PaymentDate=$_POST['PaymentDate'];
	$sql="INSERT INTO payment (WorkshopID,Amount,PaymentDate) VALUES('$WorkshopID','$Amount','$PaymentDate')";
		$result=$connection->query($sql);
	if ($result) {
		echo"Inserted Successfully";
		header("location:viewpayment.php");
		exit();
	}else{
		echo "Inserted fail";
	}

}

?>


