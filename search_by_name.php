<?php
require "connection_database.php";
class search_by_name{
    // $search_req="";
    public function search($conn){
        $this->search_req = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['submit'])){
                if(!empty($_POST['search_text'])){
                    // $searchq=$final;
                    session_start();
                    $this->searchq2=$_POST['search_text'];
                    // $final=$_SESSION['search2'];
                    // $searchq=$final;
                    // echo $final;
                    $_SESSION['search2']=$this->searchq2;
                    $this->search_req="";
                    $this->query = "SELECT name FROM users WHERE name = '$this->searchq2'";
                    $this->sql = $conn->query($this->query);
                    if($this->sql->num_rows > 0){
                        header("location:customer_search.php");
                    }
                    else{
                        $this->search_req="No search result found for '$this->searchq2'";
                    }
                }   
                else{
                    $this->search_req="Search should be filled";
                }
            }
        }
    }
}
$conn = new Database("localhost","root","ksmmtn921112","obd2");
$link = $conn->connect();
$c = new search_by_name();
$c->search($link);
?>

<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Webslesson Tutorial</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
 </head>
 <body >
  <div class="container">
    <br /></br>
    <!-- <h2 align="center">Ajax Live Data Search using Jquery PHP MySql</h2><br />  -->
        <button class="search_data" style="width:100px;height:40px;background-color:rgba(0,0,0,0.1);color:black;border-radius:5px;border:1px solid white;
                                margin-top:0px;margin-left:5px;float:right;" onclick="back()">Back</button>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon" style="height:30px;">Search</span>
        <input style="height:40px;width:500px;" type="text" name="search_text" id="search_text" placeholder="Search by Customer Name" autocomplete="off" class="form-control"/>
        <input type="submit" name="submit" value=">>" style="margin-left:10px;margin-top:1px;height:30px;width:30px;background-color:white;color:black;" class="btn btn-info btn-xs view_data">
        <span class="error" style="color:black;margin-left:50px;"><?php echo $c->search_req?></span>
        </form>
    </div>
   </div>
   <br />
   <div id="result"></div>
  </div>
 </body>
</html>


<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch_by_name.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});

function back(){
    location.replace("dashboard.php")
}
</script>

<!-- <?php 
session_start();
        $final=$_SESSION['search2'];
        // $searchq=$final;
        echo $final;
?> -->