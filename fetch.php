<?php
require "connection_database.php";
class fetch{
    public function retrieve($conn){
        if(isset($_POST["customer_id"]))  
        {  
            $query = "SELECT * FROM users WHERE id = '".$_POST["customer_id"]."'";  
            $result = $conn->query($query);  
            $row = $result->fetch_array();  
            echo json_encode($row);  
        }
    }
}
$conn = new Database("localhost","root","ksmmtn921112","obd2");
$link = $conn->connect();
$f = new fetch();
$f->retrieve($link);
?>