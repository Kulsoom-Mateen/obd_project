<?php
require "connection_database.php";
class view{
        public function query1($conn){
                if(isset($_POST["customer_id"])){
                        // $this->output = '';
                        // $this->output1 = ''; 
                        $query = "SELECT bulk_id,batch_id,speed,fuel_level,coolant_temperature,intake_manifold_abs_pressure,intake_air_temperature,
                        mass_flow_rate,throttle_position,engine_load,timestamp FROM data_bulk WHERE bulk_id in (SELECT MAX(dd.bulk_id) FROM 
                        data_bulk dd , data_batch d , users u WHERE dd.batch_id=d.batch_id and d.user_id='".$_POST["customer_id"]."')"; 
                        $result = $conn->query($query);  
                        // $query1 = "SELECT * FROM users WHERE id='".$_POST["customer_id"]."'";
                        // $result1 = $conn->mysqli_query($query1);  
                        return $result;
                }
        }
        public function query2($conn){
                $query1 = "SELECT * FROM users WHERE id='".$_POST["customer_id"]."'";
                $result1 = $conn->query($query1); 
                return $result1;
        }
        public function show($q1_result,$q2_result){
                $this->output = '';
                $this->output1 = '';
                $this->output1 .= ' 
                <div class="table-responsive">  
                        <table class="table table-bordered">';  
                while($row1 = $q2_result->fetch_array())  
                {  
                        $this->output1 .= '  
                        <tr>  
                                <td width="50%"><label>ID</label></td>  
                                <td width="50%">'.$row1["id"].'</td>  
                        </tr> 
                        <tr>  
                                <td width="30%"><label>Email</label></td>  
                                <td width="70%">'.$row1["email"].'</td>  
                        </tr>
                        <tr>  
                                <td width="30%"><label>Name</label></td>  
                                <td width="70%">'.$row1["name"].'</td>  
                        </tr>  
                        <tr>  
                                <td width="30%"><label>Vehicle</label></td>  
                                <td width="70%">'.$row1["vehicle"].'</td>  
                        </tr>
                        ';  
                }  
                $this->output1 .= "</table></div>";  
                echo $this->output1;
                
                $this->output .= '  
                <div  style="margin-top:-20px;" class="table-responsive">  
                        <table class="table table-bordered">';  
                while($row = $q1_result->fetch_array())  
                {  
                        $this->output .= '  
                        <tr>  
                                <td width="50%"><label>Speed</label></td>  
                                <td width="50%">'.$row["speed"].' km/h</td>  
                        </tr> 
                        <tr>  
                                <td width="30%"><label>Fuel Level</label></td>  
                                <td width="70%">'.$row["fuel_level"].' %</td>  
                        </tr> 
                        <tr>  
                                <td width="30%"><label>Coolant Temperature</label></td>  
                                <td width="70%">'.$row["coolant_temperature"].' *C</td>  
                        </tr> 
                        <tr>  
                                <td width="30%"><label>Intake Manifold Abs. Pressure</label></td>  
                                <td width="70%">'.$row["intake_manifold_abs_pressure"].' KPa</td>  
                        </tr> 
                        <tr>  
                                <td width="30%"><label>Intake Air Temperature</label></td>  
                                <td width="70%">'.$row["intake_air_temperature"].' *C</td>  
                        </tr> 
                        <tr>  
                                <td width="30%"><label>Mass Flow Rate</label></td>  
                                <td width="70%">'.$row["mass_flow_rate"].' g/s</td>  
                        </tr> 
                        <tr>  
                                <td width="30%"><label>Throttle Position</label></td>  
                                <td width="70%">'.$row["throttle_position"].' %</td>  
                        </tr>  
                        <tr>  
                                <td width="30%"><label>Engine Load</label></td>  
                                <td width="70%">'.$row["engine_load"].' %</td>  
                        </tr>  
                        <tr>  
                                <td width="30%"><label>Timestamp</label></td>  
                                <td width="70%">'.$row["timestamp"].'</td>  
                        </tr>   
                        ';  
                }  
                $this->output .= "</table></div>";  
                echo $this->output;  
        }
}
$conn = new Database("localhost","root","ksmmtn921112","obd2");
$link = $conn->connect();
$v1 = new view();
$q1_result = $v1->query1($link);
$q2_result = $v1->query2($link);
$v1->show($q1_result,$q2_result);
?>