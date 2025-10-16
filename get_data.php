<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "2mic";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){ die(json_encode(["error"=>$conn->connect_error])); }

$allowed = ["Protest","Political Meetings / Media Conference","Delegation Visits","Other"];

$sql = "SELECT SER, DATE, CATEGORY, LOCATION, LAT, LON, DESCRIPTION FROM incidents";
$result = $conn->query($sql);

$data = [];
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    if(!in_array($row['CATEGORY'],$allowed)){ $row['CATEGORY']="Other"; }
    $data[]=$row;
  }
}

echo json_encode($data);
$conn->close();
?>
