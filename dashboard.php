<?php
require "connection_database.php";
class dashboard{
    public $invalid="";
    public $search_req=""; 
    // public function show($conn){
    //     $query = "SELECT * FROM users";
    //     $result = $conn->query($query);
    //     return $result;
    // } 
    
    /////////////////////////////////////////////dashboard search button coding//////////////////////////////////////
    public function search($conn){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['submit'])){
                if(!empty($_POST['search'])){
                    $this->searchq=$_POST['search'];
                    session_start();
                    $_SESSION['search1']=$this->searchq;
                    // $search_req="";
                    $sql = "SELECT id FROM users WHERE id = '$this->searchq'";
                    $result1 = $conn->query($sql);
                    if($result1->num_rows > 0){
                        header("location:customers.php");
                    }
                    else{
                        return "No search result found";
                    }
                }   
                else{
                    return "Search should be filled";
                }
            }
        }
    }
    /////////////////////////////////////////////dashboard search button coding//////////////////////////////////////
    



}

$conn = new Database("localhost","root","ksmmtn921112","obd2");
$link = $conn->connect();
$d = new dashboard();
$search_req = $d->search($link);
?>


<!DOCTYPE html>
<html lang="en" style="100%">

<head>
    <script type="text/javascript">
        function preventBack(){
            window.history.forward();
        }
        setTimeout("preventBack()",0);
        window.onunload=function(){null};
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Dashboard</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <style>
        body {
        font-family: "Arial", Serif;
        background-color: #f4f4f4;
        /* overflow-x: hidden; */
        }

        .side-nav {
        /* height: 80%; */
        width: 20%;
        /* position: fixed ; */
        top: 0;
        left: 0;
        background:black;
        opacity: 0.7 ;
        padding-top: 10px;
        transition: 0.5s;
        display:block;
        min-width:170px;
        /* background-color: #111; */
        /* z-index: 1; */
        /* overflow-x: hidden; */
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
        <li class="active"><a href="#">Dashboard</a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Customers <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <div class="side-nav">
                <a name="insert" id="insert" data-toggle="modal" data-target="#insert_data_Modal">Add Customer</a>
                <a>Delete customer</a>
            </div>
            </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> Details <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <div class="side-nav">
                <a>Update</a>
                <a>Statistics</a>
                <a>Report</a>
            </div>
            </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <div class="side-nav">
                <a>Reset password</a>
                <a href="login.php">Logout</a>
            </div>
            </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Search <span class="caret"></span></a>
        <!-- <span class="glyphicon glyphicon-search form-control-feedback" style="float:left;margin-right:-10px;color:white;" ></span> -->
                
            <ul class="dropdown-menu">
            <div class="side-nav">
                <a href="search_by_name.php">By name</a>
                <a href="search_by_id.php">By ID</a>
            </div>
            </ul>
        </li>
        <li style="margin-top:10px;margin-left:13px;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">


            <!-- /////////////////////////////////////////////dashboard search button coding/////////////////////////////////////// -->
                <!-- <input style="width:250px;float:left;" type="text" class="form-control" id="inputSuccess2" placeholder="Search" name="search"> -->
                <!-- <span class="glyphicon glyphicon-search form-control-feedback" style="float:left;margin-right:40px;" ></span> -->
                <!-- <input type="submit" name="submit"value=">>" style="margin-left:10px;margin-top:1px;height:30px;width:30px;background-color:white;color:black;" class="btn btn-info btn-xs view_data"> -->
            <!-- /////////////////////////////////////////////dashboard search button coding////////////////////////////////////// -->


        </br><span class="error" style="color:white;margin-left:50px;"><?php echo $search_req;?></span>
            </form>
        </li>
    </ul>
  </div>
</nav>

<div class="container" style="width:63%;margin-left:0px;float:left;">  
    <div class="table-responsive">  
        <div align="right">
        <button type="button" name="add" id="add" data-toggle="modal" data-target="#insert_data_Modal" class="btn btn-warning" style="margin-left:0%;width:140px;height:40px;font-size:13px;background-color:rgba(116,10,110,0.5);border:1px solid purple;">Add Customer</button>
        </div>
        <br />
        <div id="customer_table">
            <table class="table table-bordered" style="background-color:rgba(0,10,200,0.1);border:2px solid purple;">  
                <tr style="border:1px solid purple;">  
                    <th width="15%" style="border:1px solid purple;"><p style="text-align:center;">Customer ID</p></th>  
                    <th width="40%" style="border:1px solid purple;"><p style="text-align:center;">Customer Name</p></th>  
                    <th width="15%" style="border:1px solid purple;"><p style="text-align:center;">View</p></th>   
                    <th width="15%" style="border:1px solid purple;"><p style="text-align:center;">Edit</p></th> 
                    <th width="15%" style="border:1px solid purple;"><p style="text-align:center;">Delete</p></th>  
                </tr>  
                <?php  
                $query = "SELECT * FROM users";
                $result = $link->query($query);
                while($row = mysqli_fetch_array($result))     
                {   
                ?>  
                <tr style="border:1px solid purple;"> 
                    <td style="text-align:center;border:1px solid purple;"><?php echo $row["id"]; ?></td> 
                    <td style="text-align:center;border:1px solid purple;"><?php echo $row["name"]; ?></td>
                    <td style="border:1px solid purple;"><input type="button" name="view" value="view" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" 
                    style="margin-left:20%;width:60px;font-size:13px;background-color:rgba(116,10,110,0.5);border:1px solid purple;"/></td> 
                    <td style="border:1px solid purple;"><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data" 
                    style="margin-left:20%;width:60px;font-size:13px;background-color:rgba(116,10,110,0.5);border:1px solid purple;"/></td> 
                    <td style="border:1px solid purple;"><input type="button" name="delete" value="Delete" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs delete_data" 
                    style="margin-left:20%;width:60px;font-size:13px;background-color:rgba(116,10,110,0.5);border:1px solid purple;"/></td>  
                </tr>  
                <?php  
                }  
                ?>  
            </table>
            <?php
            // echo "<a style='margin-left:60px;font-size:20px;' href='dashboard.php?page=$page'><button><em>PREVIOUS</em></button>"; 
            // for($page=1; $page<= $no_of_page; $page++){ 
            //     if($page<=3){
            //         echo "<a style='margin-left:60px;font-size:20px;' href='dashboard.php?page=$page'><button><em>$page</em></button>"; 
            //     }
            //     else{
            //         echo "<a style='margin-left:60px;font-size:20px;' href='dashboard.php?page=$page'><button><em>NEXT</em></button>"; 
            //         break;
            //     }
            // }
            ?>
        </div>
    </div>  
</div>


<div id="dataModal" class="modal fade">  
    <div class="modal-dialog">  
        <div class="modal-content">  
            <div class="modal-header">  
                <button type="button" class="close" data-dismiss="modal">&times;</button>  
                <h4 class="modal-title">Customer Details</h4>  
            </div>  
            <div class="modal-body" id="customer_detail">  
            </div>  
            <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
            </div>  
        </div>  
    </div>  
</div> 

<div id="insert_data_Modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Insert Data</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    <label>Enter Customer Email</label>
                    <input type="text" name="email" id="email" class="form-control" />
                    <br />
                    <label>Enter Customer Password</label>
                    <input type="text" name="password" id="password" class="form-control" />
                    <br />
                    <label>Enter Customer Name</label>
                    <input type="text" name="name" id="name" class="form-control" />
                    <br />  
                    <label>Enter Customer Vehicle</label>
                    <input type="text" name="vehicle" id="vehicle" class="form-control" />
                    <br />  
                    <input type="hidden" name="customer_id" id="customer_id" />  
                    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="edit_data_Modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Data</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="edit_form">
                    <label>Enter Customer Email</label>
                    <input type="text" name="email" id="email1" class="form-control" />
                    <br />
                    <label>Enter Customer Password</label>
                    <input type="text" name="password" id="password1" class="form-control" />
                    <br />
                    <label>Enter Customer Name</label>
                    <input type="text" name="name" id="name1" class="form-control" />
                    <br />  
                    <label>Enter Customer Vehicle</label>
                    <input type="text" name="vehicle" id="vehicle1" class="form-control" />
                    <br />  
                    <input type="hidden" name="customer_id" id="customer_id1" />  
                    <input type="submit" name="insert" id="update" value="Update" class="btn btn-success" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>  
$(document).ready(function(){
    $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
    });  
    $(document).on('click', '.view_data', function(){
    var customer_id = $(this).attr("id");
    $.ajax({
    url:"view.php",
    method:"POST",
    data:{customer_id:customer_id},
    success:function(data){
    $('#customer_detail').html(data);
    $('#dataModal').modal('show');
    }
    });
    });
    $(document).on('click', '.edit_data', function(){  
        var customer_id = $(this).attr("id");  
        $.ajax({  
            url:"fetch.php",  
            method:"POST",  
            data:{customer_id:customer_id},  
            dataType:"json",  
            success:function(data){  
                $('#email1').val(data.email);  
                $('#password1').val(data.password);  
                $('#name1').val(data.name);  
                $('#vehicle1').val(data.vehicle); 
                $('#customer_id1').val(data.id);
                $('#update1').val("Update");  
                $('#edit_data_Modal').modal('show');  
            }
        });  
    });  
    $('#edit_form').on("submit", function(event){  
    event.preventDefault();  
    if($('#email1').val() == "")  
    {  
    alert("Email is required");  
    }  
    else if($('#password1').val() == '')  
    {  
    alert("Password is required");  
    }  
    else if($('#name1').val() == '')
    {  
    alert("Name is required");  
    }
    else if($('#vehicle1').val() == '')
    {  
    alert("Vehicle is required");  
    }
    else  
    {  
    $.ajax({  
    url:"update.php",  
    method:"POST", 
    data:$('#edit_form').serialize(),  
    // beforeSend:function(){  
    //     $('#update').val("Updating");  
    // },  
    success:function(data){  
        $('#edit_form')[0].reset();  
        $('#edit_data_Modal').modal('hide');  
          $('#customer_table').html(data);  
    }  
    });  
    }  
    });


    $('#insert_form').on("submit", function(event){  
    event.preventDefault();  
    if($('#email').val() == "")  
    {  
    alert("Email is required");  
    }  
    else if($('#password').val() == '')  
    {  
    alert("Password is required");  
    }  
    else if($('#name').val() == '')
    {  
    alert("Name is required");  
    }
    else if($('#vehicle').val() == '')
    {  
    alert("Vehicle is required");  
    }
    else  
    {  
    $.ajax({  
    url:"insert.php",  
    method:"POST",  
    data:$('#insert_form').serialize(),  
    beforeSend:function(){  
        $('#insert').val("Inserting");  
    },  
    success:function(data){  
        $('#insert_form')[0].reset();  
        $('#insert_data_Modal').modal('hide');  
        $('#customer_table').html(data);
    }  
    });  
    }  
    });
});  
// location.reload();
</script>

<div id="container2" style="width:35%;height:350px;border:2px solid black;margin-left:6px;margin-top:0px;float:left;"></div>
    <script type="text/javascript">
        $(document).ready(function(){
            var options= {
                chart: {
                    renderTo: 'container2',
                    type: 'pie'
                },
                title: {
                    text: 'Percentage of vehicles having OBD2 scanner'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
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
                series:[{}]
            };
            $.getJSON('vehicle_percentage.php' , function(data){
                options.series[0].data = data;
                var chart = new Highcharts.Chart(options);
            });
        });
    </script>