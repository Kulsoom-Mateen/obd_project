<?php
$servername = "localhost";
$dbname = "obd2";
$username = "root";
$password = "ksmmtn921112";
 
try{
    $conn = new PDO("mysql:host={$servername};dbname={$dbname}",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    die($ex->getMessage());
}

$start=$conn->prepare("SELECT vehicle,COUNT(vehicle) AS count FROM users GROUP BY vehicle ORDER BY COUNT(vehicle) ASC,vehicle");
$start->execute();
while($row=$start->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $json[]=[$vehicle,(int)$count];
}
echo json_encode($json);
?>