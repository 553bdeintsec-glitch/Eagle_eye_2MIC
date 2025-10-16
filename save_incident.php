<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "2mic";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){ die("Connection failed: ".$conn->connect_error); }

$SER = $_POST['SER'] ?? '';
$DATE = $_POST['DATE'] ?? '';
$CATEGORY = $_POST['CATEGORY'] ?? 'Other';
$LOCATION = $_POST['LOCATION'] ?? '';
$LAT = $_POST['LAT'] ?? '';
$LON = $_POST['LON'] ?? '';
$DESCRIPTION = $_POST['DESCRIPTION'] ?? '';

if(!is_numeric($LAT) || !is_numeric($LON)){ die("Invalid latitude or longitude."); }

$stmt = $conn->prepare("INSERT INTO incidents (SER, DATE, CATEGORY, LOCATION, LAT, LON, DESCRIPTION) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("ssssdds",$SER,$DATE,$CATEGORY,$LOCATION,$LAT,$LON,$DESCRIPTION);

if($stmt->execute()){ echo "Incident added successfully"; }
else{ echo "Error: ".$stmt->error; }

$stmt->close();
$conn->close();
?>
