<?php
require "connection_database.php";
class customer_search{
    public function customer($conn){
        session_start();
        $this->searchq2=$_SESSION['search2'];
        $this->sql2="select id from users where name='$this->searchq2'";
        $this->result2=$conn->query($this->sql2);
        $row2=$this->result2->fetch_assoc();
        $this->id1=$row2["id"];
        $_SESSION['abc']=$this->id1;
        $this->sql1="select id,name,vehicle,email from users where id=$row2[id]";
        $this->result1=$conn->query($this->sql1); 
        while($row1 = mysqli_fetch_assoc($this->result1)){
            $this->id=$row1["id"]; 
            $this->name=$row1["name"];
            $this->vehicle=$row1["vehicle"];
            $this->email=$row1["email"];
        }
        $this->sql = "SELECT bulk_id,batch_id,speed,fuel_level,coolant_temperature,intake_manifold_abs_pressure,intake_air_temperature,mass_flow_rate,
                throttle_position,engine_load FROM data_bulk WHERE bulk_id in (SELECT MAX(dd.bulk_id) FROM data_bulk dd , data_batch d , users u 
                where dd.batch_id=d.batch_id and (d.user_id='$this->id1' or u.name='$this->id1'))"; 

        $this->result = $conn->query($this->sql);
        if($this->result){
            if($this->result->num_rows==1){
                while($row = $this->result->fetch_assoc()) {
                    $this->speed=$row["speed"];
                    $this->fuel_level=$row["fuel_level"];
                    $this->coolant_temperature=$row["coolant_temperature"];
                    $this->pressure=$row["intake_manifold_abs_pressure"];
                    $this->intake_air_temperature=$row["intake_air_temperature"];
                    $this->mass_flow_rate=$row["mass_flow_rate"];
                    $this->throttle_position=$row["throttle_position"];
                    $this->engine_load=$row["engine_load"];
                }
            }
            else{
                $this->speed="Not found";
                $this->fuel_level="Not found";
                $this->coolant_temperature="Not found";
                $this->pressure="Not found";
                $this->intake_air_temperature="Not found";
                $this->mass_flow_rate="Not found";
                $this->throttle_position="Not found";
                $this->engine_load="Not found";
            }
        }
    }
}
$conn = new Database("localhost","root","ksmmtn921112","obd2");
$link = $conn->connect();
$c = new customer_search();
$c->customer($link);
$searchq=$_SESSION['search2'];
// $searchq=$c->searchq;
// echo $searchq;
?>

<!-- $servername = "localhost";
$username = "root";
$password = "ksmmtn921112";
$dbname = "obd2";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//after searching from dashboard page
//for accepting search variable from dashboard page and then searching from database to show values
// $searchq = $_GET['search'];
// session_start();
// $searchq=$_SESSION['search1'];
// $sql2="select id from users where name='$searchq'";
// $result2=mysqli_query($conn,$sql2);
// $row2=mysqli_fetch_assoc($result2);
// $id1=$row2["id"];
// $_SESSION['abc']=$id1;
// $sql1="select id,name,vehicle,email from users where id=$row2[id]";
// $result1=mysqli_query($conn, $sql1); 
// while($row1 = mysqli_fetch_assoc($result1)) {
//     $id=$row1["id"]; 
//     $name=$row1["name"];
//     $vehicle=$row1["vehicle"];
//     $email=$row1["email"];
// }
// //This query needs to be changed
// $sql = "SELECT bulk_id,batch_id,speed,fuel_level,coolant_temperature,intake_manifold_abs_pressure,intake_air_temperature,mass_flow_rate,
//         throttle_position,engine_load FROM data_bulk WHERE bulk_id in (SELECT MAX(dd.bulk_id) FROM data_bulk dd , data_batch d , users u 
//         where dd.batch_id=d.batch_id and (d.user_id='$id1' or u.name='$id1'))"; 

// $result = mysqli_query($conn, $sql);
// if($result){
//     $rr=mysqli_num_rows($result);
//     if($rr==1){
//         while($row = mysqli_fetch_assoc($result)) {
//             $speed=$row["speed"];
//             $fuel_level=$row["fuel_level"];
//             $coolant_temperature=$row["coolant_temperature"];
//             $pressure=$row["intake_manifold_abs_pressure"];
//             $intake_air_temperature=$row["intake_air_temperature"];
//             $mass_flow_rate=$row["mass_flow_rate"];
//             $throttle_position=$row["throttle_position"];
//             $engine_load=$row["engine_load"];
//         }
//     }
//     else{
//         $speed="Not found";
//         $fuel_level="Not found";
//         $coolant_temperature="Not found";
//         $pressure="Not found";
//         $intake_air_temperature="Not found";
//         $mass_flow_rate="Not found";
//         $throttle_position="Not found";
//         $engine_load="Not found";
//     }
// }



// }
// else{
//     $speed="";
//     $fuel_level="";
//     $coolant_temperature="";
//     $pressure="";
//     $intake_air_temperature="";
//     $mass_flow_rate="";
//     $throttle_position="";
//     $engine_load="";
// }
// $search_req1="";
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// if(isset($_POST['submit'])){
//     if(!empty($_POST['searchh'])){
//         $searchq1=$_POST['searchh'];    
//         session_start();
//         $_SESSION['searchh1']=$searchq1;
//         $search_req1="";
//         header("location:customer_search.php");
//     }   }
//     else{
//         $search_req1="Search should be filled";
//     }
// }

//after searching from customer page 
//if search from customer page then all the variables of search of dashboard page will change with customer page search value
// if(isset($_POST['submit'])){
//     $searchq=$_POST['search'];
//     $sql = "SELECT u.id,MAX(d.batch_id),MAX(dd.bulk_id),speed,fuel_level,coolant_temperature,intake_manifold_abs_pressure,
//             intake_air_temperature,mass_flow_rate,throttle_position,engine_load from data_bulk dd , data_batch d , users u 
//             where u.id=d.user_id and d.batch_id=dd.batch_id and u.id='$searchq'";
//     $result = mysqli_query($conn, $sql);
//     while($row = mysqli_fetch_assoc($result)) {
//         $speed=$row["speed"];
//         $fuel_level=$row["fuel_level"];
//         $coolant_temperature=$row["coolant_temperature"];
//         $pressure=$row["intake_manifold_abs_pressure"];
//         $intake_air_temperature=$row["intake_air_temperature"];
//         $mass_flow_rate=$row["mass_flow_rate"];
//         $throttle_position=$row["throttle_position"];
//         $engine_load=$row["engine_load"];
//     }
// }
?> -->

<!DOCTYPE html>
<html lang="en" style="100%">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Customers</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <style>
        body {
        font-family: "Arial", Serif;
        background-color: #f4f4f4;
        }

        .side-nav {
        width: 20%;
        top: 0;
        left: 0;
        background:black;
        opacity: 0.7 ;
        padding-top: 10px;
        transition: 0.5s;
        display:block;
        min-width:170px;
        }

        .side-nav a {
        padding: 10px 10px 10px 20px;
        text-decoration: none;
        font-size: 12px;
        color: #ccc;
        display: block;
        transition: 0.6s;
        margin-top: 0px;
        /* border:1px solid black; */
        }

        .side-nav a:hover {
        color: purple;
        background-color:#ccc;
        }
        
        .dropdown1{
        position:relative;
        display:block;
        }
        
        .dropdown-content{
        display:none;
        position:absolute;
        margin-left:130px;
        padding:0px;
        margin-top:-35px;
        width:122px;
        }
    
        .dropdown-content a{
        color:#ccc;
        display:block;
        }
    
        .dropdown1:hover .dropdown-content{
        display:block;
        background-color:black;
        /* border:1px solid black; */
        }

        .top{
        background-color:rgba(110,0,160,0.2);
        width:99%;
        height:10%;
        float:right;
        position:absolute;
        margin-left:0;
        display:flex;
        flex-wrap:wrap;
        overflow:hidden;
        margin-top:-8px;
        /* border:2px solid black; */
        /* max-width:1080px; */
        z-index:1000;
        }

        @media screen and (max-width:150px) {
        .top {
        width: 100%;
        }
        }

        @media screen and (max-width:600px) {
        .box {
        width: 90%;
        }
        } 

        .flex-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width:80%;
        overflow:hidden;
        margin-left:20.2%;
        margin-top:-10px;
        /* padding:0px 20px 0px 5px; */
        background-color: rgba(110,0,160,0.4);
        }

        .flex-container > div {
        background-color: #f1f1f1;
        width: 100px;
        margin-right:200px;
        text-align: center;
        line-height: 75px;
        font-size: 30px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid" style="background-color:purple;color:#ccc;">
        <h1>OBD2</h1>
    </div>
  <div class="container-fluid" style="background-color:(0,0,0,0.5);">
    <ul class="nav navbar-nav">
        <li ><a href="dashboard.php">Dashboard</a>
        </li>
        <li class="active"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Customers <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <div class="side-nav">
                <a href="user_profile.php?name=<?php echo $name1;?>" onclick="profile()">Add customer</a>
                <a href="user_profile.php?name=<?php echo $name1;?>" onclick="profile()">Delete customer</a>
            </div>
            </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> Details <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <div class="side-nav">
                <a href="user_profile.php?name=<?php echo $name1;?>" onclick="">Update</a>
                <a href="user_profile.php?name=<?php echo $name1;?>" onclick="">Statistics</a>
                <a href="user_profile.php?name=<?php echo $name1;?>" onclick="">Report</a>
            </div>
            </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Settings <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <div class="side-nav">
                <a href="user_profile.php?name=<?php echo $name1;?>" onclick="">Reset password</a>
                <a href="login.php">Logout</a>
            </div>
            </ul>
        </li>
        <li>
            <button class="" style="width:100px;height:36px;background-color:white;border-radius:5px;margin-top:8px;margin-left:50px;" onclick="back()">Back</button>
        </li>
    </ul>
  </div>
</nav>
<script>
    function back(){
        location.replace("dashboard.php")
    }
</script>
<div style="margin-top:-19px;background-color:rgba(110,0,160,0.2);padding:10px;width:100%;flex-wrap:wrap;"> 
    <button type="button" class="btn btn-lg" style="margin-right:0px;background-color:white;border:1px solid purple;width:110px;"><h4><img src="speed.jpg" style="height:40px;"></br>Speed</br>&nbsp(km/h)&nbsp<h4><?php echo $c->speed;?></h4></h4></button>
    <button type="button" class="btn btn-lg" style="margin-right:0px;background-color:white;border:1px solid purple;width:110px;"><h4><img src="fuel_level.jpg" style="height:40px;"></br>Fuel Level</br>(%)<h4><?php echo $c->fuel_level;?></h4></h4></button>
    <button type="button" class="btn btn-lg" style="margin-right:0px;background-color:white;border:1px solid purple;width:110px;"><h4><img src="RPM.jpg" style="height:40px;"></br>Engine</br>RPM<h4><?php echo 'RPM';?></h4></h4></button>
    <button type="button" class="btn btn-lg" style="margin-right:0px;background-color:white;border:1px solid purple;width:110px;"><h4><img src="engine_oil.jpg" style="height:40px;"></br>Engine Oil</br>(*C)<h4><?php echo 'Engine oil';?></h4></h4></button>
    <button type="button" class="btn btn-lg" style="margin-right:0px;background-color:white;border:1px solid purple;width:160px;"><h4><img src="coolant_temperature.jpg" style="height:40px;"></br>Coolant</br>Temperature(*C)<h4><?php echo $c->coolant_temperature;?></h4></h4></button>
    <button type="button" class="btn btn-lg" style="margin-right:0px;background-color:white;border:1px solid purple;width:180px;"><h4><img src="pressure.jpg" style="height:40px;"></br>Intake Manifold </br>AbsPressure(KPa)<h4><?php echo $c->pressure;?></h4></h4></button>
    <button type="button" class="btn btn-lg" style="margin-right:0px;background-color:white;border:1px solid purple;width:160px;"><h4><img src="intake_air_temperature.jpg" style="height:40px;"></br>Intake Air</br> Temperature(*C)<h4><?php echo $c->intake_air_temperature;?></h4></h4></button>
    <button type="button" class="btn btn-lg" style="margin-right:0px;background-color:white;border:1px solid purple;width:117px;"><h4><img src="mass_flow_rate.jpg" style="height:40px;"></br>Mass Flow</br>Rate (g/s)<h4><?php echo $c->mass_flow_rate;?></h4></h4></button>
    <button type="button" class="btn btn-lg" style="margin-right:0px;background-color:white;border:1px solid purple;width:117px;"><h4><img src="throttle_position.jpg" style="height:40px;"></br>Throttle</br>Position(%)<h4><?php echo $c->throttle_position;?></h4></h4></button>
    <button type="button" class="btn btn-lg" style="margin-right:0px;background-color:white;border:1px solid purple;width:117px;"><h4><img src="engine_load.jpg" style="height:40px;"></br>Engine</br>Load(%)<h4><?php echo $c->engine_load;?></h4></h4></button>
</div>

<div style="height:403px;width:33%;float:left;margin-left:3px;background-color:rgba(240,180,10,0.1);">
    <div class="panel-heading" style="height:70px;border-radius:10px;background-color:rgba(160,16,230,0.5);text-align:center;margin-top:3px;"><h3 style="margin-top:6px;">Customer details</h3><b>ID  :</b>  <b><?php echo $c->id;?></b></div>
        <div class="panel-body" style="margin-top:7px;border-radius:20px;margin-left:10px;height:100px;width:95%;background-color:rgba(0,255,0,0.2);padding-left:30px;"><h5><b>Name : </b></h5><h4 style="margin-top:30px;width:100%;"><b><?php echo $c->name;?></b><img src="customer.png" style="width:20%;margin-top:-60px;float:right;height:80px;"></h4></div>
        <div class="panel-body" style="margin-top:10px;border-radius:20px;margin-left:10px;height:100px;width:95%;background-color:rgba(255,0,0,0.2);padding-left:30px;"><h5><b>Email : </b></h5><h4 style="margin-top:30px;"><b><?php echo $c->email;?></b><img src="email.png" style="width:20%;margin-top:-55px;float:right;height:70px;"></h4></div>
        <div class="panel-body" style="margin-top:10px;border-radius:20px;margin-left:10px;height:100px;width:95%;background-color:rgba(0,0,255,0.2);padding-left:30px;"><h5><b>Vehicle : </b></h5><h4 style="margin-top:30px;"><b><?php echo $c->vehicle;?></b><img src="vehicle.png" style="width:20%;margin-top:-60px;float:right;height:75px;"></h4></div>
</div>
<div id="container1" style="width:33%; height:400px;float:left;border:2px solid black;margin-left:3px;margin-top:3px;color:black;"></div>
        <script type="text/javascript">
            $(document).ready(function(){
                var options= {
                    chart: {
                        renderTo: 'container1',
                        type: 'line',
                        // backgroundColor:'#CCDDFF'
                    },
                    title:{
                        text: "Speed (km/h)"
                    },
                    // subtitle:{
                    //     text:"Hy"
                    // },
                    yAxis:{
                        title:{
                            text:"Reading"
                        }
                    },
                    xAxis:{},
                    legend: {
                        layout: 'vertical',
                        align: 'left',
                        verticalAlign: 'middle'
                    },
                     series:[{}]
                };
                $.getJSON('customers_data_speed1.php' , function(data){
                    options.series[0].data = data;
                    options.series[0].color='#0048BA';
                    options.series[0].name = <?php echo $c->id1;?>;
                    var chart = new Highcharts.Chart(options);
                });
            });
        </script>
<div id="container2" style="width:33%; height:400px;float:left;border:2px solid black;margin-left:3px;margin-top:3px;"></div>
        <script type="text/javascript">
            $(document).ready(function(){
                var options= {
                    chart: {
                        renderTo: 'container2',
                        type: 'line',
                        // backgroundColor:'#FFCFAB'
                    },
                    title:{
                        text: "Fuel Level (%)"
                    },
                    // subtitle:{
                    //     text:"Hy"
                    // },
                    yAxis:{
                        title:{
                            text:"Reading"
                        }
                    },
                    xAxis:{},
                    legend: {
                        layout: 'vertical',
                        align: 'left',
                        verticalAlign: 'middle'
                    },
                     series:[{}]
                };
                $.getJSON('customers_data_fuellevel1.php' , function(data){
                    options.series[0].data = data;
                    options.series[0].color='#FF6A4D';
                    options.series[0].name = <?php echo $c->id1; ?>;
                    var chart = new Highcharts.Chart(options);
                });
            });
        </script>
<div id="container3" style="width:33%; height:400px;float:left;border:2px solid black;margin-left:3px;margin-top:3px;"></div>
        <script type="text/javascript">
            $(document).ready(function(){
                var options= {
                    chart: {
                        renderTo: 'container3',
                        type: 'line',
                        // backgroundColor:'#F19CBB'
                    },
                    title:{
                        text: "Coolant Temperature (*C)"
                    },
                    yAxis:{
                        title:{
                            text:"Reading"
                        }
                    },
                    xAxis:{},
                    legend: {
                        layout: 'vertical',
                        align: 'left',
                        verticalAlign: 'middle'
                    },
                     series:[{}]
                };
                $.getJSON('customers_data_coolantTemperature1.php' , function(data){
                    options.series[0].data = data;
                    options.series[0].color='#E60099';
                    options.series[0].name = <?php echo $c->id1; ?>;
                    var chart = new Highcharts.Chart(options);
                });
            });
        </script>
<div id="container4" style="width:33%; height:400px;float:left;border:2px solid black;margin-left:3px;margin-top:3px;"></div>
        <script type="text/javascript">
            $(document).ready(function(){
                var options= {
                    chart: {
                        renderTo: 'container4',
                        type: 'line',
                        // backgroundColor: '#AA99FF'
                    },
                    title:{
                        text: "Intake Manifold Abs. Pressure (KPa)"
                    },
                    yAxis:{
                        title:{
                            text:"Reading"
                        }
                    },
                    xAxis:{},
                    legend: {
                        layout: 'vertical',
                        align: 'left',
                        verticalAlign: 'middle'
                    },
                     series:[{}]
                };
                $.getJSON('customers_data_mmanifoldPressure1.php' , function(data){
                    options.series[0].data = data;
                    options.series[0].color='#4400CC';
                    options.series[0].name = <?php echo $c->id1; ?>;
                    var chart = new Highcharts.Chart(options);
                });
            });
        </script>
<div id="container5" style="width:33%; height:400px;float:left;border:2px solid black;margin-left:3px;margin-top:3px;"></div>
        <script type="text/javascript">
            $(document).ready(function(){
                var options= {
                    chart: {
                        renderTo: 'container5',
                        type: 'line',
                        // backgroundColor: '#99FFCC'
                    },
                    title:{
                        text: "Intake Air Temperature (*C)"
                    },
                    yAxis:{
                        title:{
                            text:"Reading"
                        }
                    },
                    xAxis:{},
                    legend: {
                        layout: 'vertical',
                        align: 'left',
                        verticalAlign: 'middle'
                    },
                     series:[{}]
                };
                $.getJSON('customers_data_intakeAirTemp1.php' , function(data){
                    options.series[0].data = data;
                    options.series[0].color='#00B395';
                    options.series[0].name = <?php echo $c->id1; ?>;
                    var chart = new Highcharts.Chart(options);
                });
            });
        </script>
<div id="container6" style="width:33%; height:400px;float:left;border:2px solid black;margin-left:3px;margin-top:3px;"></div>
        <script type="text/javascript">
            $(document).ready(function(){
                var options= {
                    chart: {
                        renderTo: 'container6',
                        type: 'line',
                        // backgroundColor: '#99CCFF'
                    },
                    title:{
                        text: "Mass Flow Rate (g/s)"
                    },
                    yAxis:{
                        title:{
                            text:"Reading"
                        }
                    },
                    xAxis:{},
                    legend: {
                        layout: 'vertical',
                        align: 'left',
                        verticalAlign: 'middle'
                    },
                     series:[{}]
                };
                $.getJSON('customers_data_massFlowRate1.php' , function(data){
                    options.series[0].data = data;
                    options.series[0].color='#198CFF';
                    options.series[0].name = <?php echo $c->id1; ?>;
                    var chart = new Highcharts.Chart(options);
                });
            });
        </script>
<div id="container7" style="width:33%; height:400px;float:left;border:2px solid black;margin-left:3px;margin-top:3px;"></div>
        <script type="text/javascript">
            $(document).ready(function(){
                var options= {
                    chart: {
                        renderTo: 'container7',
                        type: 'line',
                        // backgroundColor: '#FFBF80'
                    },
                    title:{
                        text: "Throttle Position (%)"
                    },
                    yAxis:{
                        title:{
                            text:"Reading"
                        }
                    },
                    xAxis:{},
                    legend: {
                        layout: 'vertical',
                        align: 'left',
                        verticalAlign: 'middle'
                    },
                     series:[{}]
                };
                $.getJSON('customers_data_throttlePosition1.php' , function(data){
                    options.series[0].data = data;
                    options.series[0].color='#E64C00';
                    options.series[0].name = <?php echo $c->id1; ?>;
                    var chart = new Highcharts.Chart(options);
                });
            });
        </script>
<div id="container8" style="width:33%; height:400px;float:left;border:2px solid black;margin-left:3px;margin-top:3px;"></div>
        <script type="text/javascript">
            $(document).ready(function(){
                var options= {
                    chart: {
                        renderTo: 'container8',
                        type: 'line',
                        // backgroundColor: '#FFB3F2'
                    },
                    title:{
                        text: "Engine Load (%)"
                    },
                    yAxis:{
                        title:{
                            text:"Reading"
                        }
                    },
                    xAxis:{},
                    legend: {
                        layout: 'vertical',
                        align: 'left',
                        verticalAlign: 'middle'
                    },
                     series:[{}]
                };
                $.getJSON('customers_data_engineLoad1.php' , function(data){
                    options.series[0].data = data;
                    options.series[0].color='#FF00FF';
                    options.series[0].name = <?php echo $c->id1; ?>;
                    var chart = new Highcharts.Chart(options);
                });
            });
        </script>
        
</body>










<!-- <div id="container" style="width:40%;height:380px;margin-left:6px;margin-top:2px;float:left;border:2px solid black;"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myChart = Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Average weekly reading'
                },
                xAxis: {
                    categories: ['Temperature', 'Speed', 'RPM' , 'Mass flow' , 'O2 B1S2']
                },
                yAxis: {
                    title: {
                        text: ''
                    }
                },
                series: [{
                    name: 'Toyota',
                    data: [80, 90 , 2 , 4 , 8]
                }, {
                    name: 'Suzuki',
                    data: [75, 80, 3 , 5 , 9]
                },{
                    name: 'Honda',
                    data: [90, 70 , 4 , 6 , 6]
                },{
                    name: 'Nissan',
                    data: [70, 75 , 1 , 2 , 10]
                },]
            });
        });
    </script>
</div>
<div class="flex-container1" style="display:flex;flex-wrap:wrap;"> 
<div id="container1" style="width:49%;height:300px;border:2px solid black;margin-left:2px;margin-top:2px;float:left;">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myChart = Highcharts.chart('container1', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Temperature ( Celsius )'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar' , 'Apr' , 'May' , 'June' , 'July' , 'Aug', 'Sep', 'Oct' , 'Nov' , 'Dec']
                },
                yAxis: {
                    title: {
                        text: ''
                    }
                },
                series: [{
                    name: '',
                    data: [80, 90 , 92 , 84 , 79 , 91 , 88 , 82 , 86 , 90 , 87 , 85]
                }
                // ,{
                //     name: 'Suzuki',
                //     data: [70, 80 , 72 , 80 , 70 , 81 , 78 , 92 , 96 , 70 , 80 , 89]
                // },{
                //     name: 'Civic',
                //     data: [84, 100 , 72 , 89 , 70 , 81 , 98 , 89 , 76 , 80 , 89 , 80]
                // },{
                //     name: 'Mehran',
                //     data: [90, 80 , 99 , 84 , 90 , 95 , 80 , 89 , 87 , 80 , 77 , 75]
                // }
                ]
            });
        });
    </script>
</div>
<div id="container2" style="width:49%;height:300px;border:2px solid black;margin-left:2px;margin-top:2px;float:left;">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myChart = Highcharts.chart('container2', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Speed ( km/h )'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar' , 'Apr' , 'May' , 'June' , 'July' , 'Aug', 'Sep', 'Oct' , 'Nov' , 'Dec']
                },
                yAxis: {
                    title: {
                        text: ''
                    }
                },
                series: [{
                    name: '',
                    data: [95,89,79,100,98,88,95,84,93,82,94,91]
                }]
            });
        });
    </script>
</div>
<div id="container3" style="width:49%;height:300px;border:2px solid black;margin-left:2px;margin-top:2px;float:left;">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myChart = Highcharts.chart('container3', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Engine RPM'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar' , 'Apr' , 'May' , 'June' , 'July' , 'Aug', 'Sep', 'Oct' , 'Nov' , 'Dec']
                },
                yAxis: {
                    title: {
                        text: ''
                    }
                },
                series: [{
                    name: '',
                    data: [5,3,3,4,6,4,2,4,3,2,4,1]
                }]
            });
        });
    </script>
</div>
<div id="container4" style="width:49%;height:300px;border:2px solid black;margin-left:2px;margin-top:2px;float:left;">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myChart = Highcharts.chart('container4', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Mass Flow'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar' , 'Apr' , 'May' , 'June' , 'July' , 'Aug', 'Sep', 'Oct' , 'Nov' , 'Dec']
                },
                yAxis: {
                    title: {
                        text: ''
                    }
                },
                series: [{
                    name: '',
                    data: [5,3,3,4,6,4,2,4,3,2,4,1]
                }]
            });
        });
    </script>
</div>
<div id="container5" style="width:49%;height:300px;border:2px solid black;margin-left:2px;margin-top:2px;float:left;">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myChart = Highcharts.chart('container5', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'O1 B1S2'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar' , 'Apr' , 'May' , 'June' , 'July' , 'Aug', 'Sep', 'Oct' , 'Nov' , 'Dec']
                },
                yAxis: {
                    title: {
                        text: ''
                    }
                },
                series: [{
                    name: '',
                    data: [5,3,3,4,6,4,2,4,3,2,4,1]
                }]
            });
        });
    </script>
</div>
</div>
<div id="container6" style="width:40%;height:300px;border:2px solid black;margin-left:6px;margin-top:-522px;float:left;">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myChart = Highcharts.chart('container6', {
                chart: {
                    // plotBackgroundColor: null,
                    // plotBorderWidth: null,
                    // plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Percentage of vehicles having OBD2 scanner'
                },
                // tooltip: {
                //     pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                // },
                // accessibility: {
                //     point: {
                //         valueSuffix: '%'
                //     }
                // },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: [{
                        name: 'Suzuki',
                        y: 41.41,
                        sliced: true,
                        selected: true
                    }, {
                        name: 'Toyota',
                        y: 21.84
                    }, {
                        name: 'Honda',
                        y: 15.85
                    },{
                        name: 'Nissan',
                        y: 12.05
                    }, {
                        name: 'Other',
                        y: 4.18
                    }]
                }]
            });
        });
    </script>
</div> -->