<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "ksmmtn921112", "obd2");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = " SELECT * FROM users WHERE name LIKE '".$search."%' ";
}
else
{
 $query = "";
}
if(!empty($query)){
$result = mysqli_query($connect, $query);
$a=mysqli_num_rows($result) ;
if( $a> 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
 ';
 while($row = mysqli_fetch_array($result))
 {
  //  echo $row["id"];
  $output .= '
   <tr>
    <td style="border:0px solid white;">
      <button onclick="go(this.value)" name="search"  class="search_data"
        style="border:1px solid white;margin-top:-9px;margin-bottom:-8px;height:40px;width:100%;text-align:left;" value="'.$row["name"].'"
        id="<?php echo $row["id"]; ?>'.$row["name"].'
      </button>
    </td>
   </tr>
  ';
  // echo $aa;
//  echo $row['name'];
// $searchq=$_POST['search'];
// // session_start();
// $_SESSION['search1']=$searchq;   
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}}

?>
<html>
<body>
<p id="i" value=""></p>
<p id="j" value=""></p>
</body>
</html>
<script>
    function go(value){
      document.getElementById('i').innerHTML=value;
      
      var javavar=document.getElementById("i").innerHTML;
      document.getElementById('i').style.display="none";
      // var javavar=document.getElementById("i").innerHTML;
      // document.getElementById("j").innerHTML="<?php 
      //   $final='"+javavar+"'; 
      //   echo $final;
        // session_start();
        // $_SESSION['search2']=$final;
        // header("location:search_by_name.php");
      // ?>"
}

// <?php
//   session_start();
//   $_SESSION['search2']=$final;
//     // echo $final; 
// ?>

// $(document).on('click', '.search_data', function(){
//     var customer_id = $(this).attr("id");
//     $.ajax({
//     url:"customers.php",
//     method:"POST",
//     data:{customer_id:customer_id},
//     // success:function(data){
//     // $('#customer_detail').html(data);
//     // $('#dataModal').modal('show');
//     // }
//     });
//     });
 
// $(document).ready(function(){
 
//   $(document).on('click', '.search_data', function(){
//   var customer_id = $(this).attr("id");
//   $.ajax({
//   url:"hh.php",
//   method:"POST",
//   data:{customer_id:customer_id},
//   success:function(data){
//   $('#customer_detail').html(data);
//   $('#dataModal').modal('show');
//   }
//   });
//   });
// });   
</script>
<!-- 
<html>
<head>
</head>
<body>
<div id="dataModal" class="modal fade">  
  <!-- <div class="modal-dialog">  
      <div class="modal-content">  
          <div class="modal-header">  
              <button type="button" class="close" data-dismiss="modal">&times;</button>  
              <h4 class="modal-title">Customer Details</h4>  
          </div> 
          <div class="modal-body" id="customer_detail" style="background-color:white;"></div>  
           <div class="modal-footer">  
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
          </div>  
      </div>  
  </div>   
  </div> 
</body>
</html> -->