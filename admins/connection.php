<?php
$servername="localhost";
$Username="root";
$Password="";
$dbname="lyfsavers";

$conn = mysqli_connect($servername,$Username,$Password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	
	
?>