<?php
include "databaseconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$Username= $_POST['Username'];
	$Email=$_POST['Email'];
	$UserType=$_POST['UserType'];
	$Password=$_POST['Password'];
	$sql="INSERT INTO users (Username,Email,UserType,Password) VALUES('$Username','$Email','$UserType','$Password')";
		$result=$connection->query($sql);
	if ($result) {
		echo"Inserted Successfully";
		header('location:login.html');
		exit();
	}else{
		echo "Inserted fail";
	}

}

?>

