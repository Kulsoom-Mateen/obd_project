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
session_start();
$searchq=$_SESSION['abc'];
// echo $searchq;
$start=$conn->prepare("SELECT u.id,d.batch_id,dd.bulk_id,timestamp,speed,fuel_level,coolant_temperature,
                       intake_manifold_abs_pressure,intake_air_temperature,mass_flow_rate,throttle_position,engine_load from data_bulk dd , 
                       data_batch d , users u where u.id=d.user_id and d.batch_id=dd.batch_id and u.id='$searchq'");
$start->execute();
$json=[];
while($row=$start->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $json[]=[(string)$timestamp,(int)$engine_load];
}
echo json_encode($json);
?>