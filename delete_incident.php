<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "2mic";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){ die("Connection failed: ".$conn->connect_error); }

$SER = $_POST['SER'] ?? '';
if(empty($SER)){ die("Invalid SER"); }

$stmt = $conn->prepare("DELETE FROM incidents WHERE SER=?");
$stmt->bind_param("s",$SER);

if($stmt->execute()){ echo "Incident deleted successfully"; }
else{ echo "Error: ".$stmt->error; }

$stmt->close();
$conn->close();
?>
