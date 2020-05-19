<?php
require "connection_database.php";
class insert{
    public function add($conn){
        if(!empty($_POST))
        {
        $this->output = '';  
            $this->email = $conn->real_escape_string($_POST["email"]);  
            $this->password = $conn->real_escape_string($_POST["password"]);  
            $this->name = $conn->real_escape_string($_POST["name"]);  
            $this->vehicle = $conn->real_escape_string($_POST["vehicle"]);
            $query = " INSERT INTO users(email, password , name, vehicle) VALUES('$this->email', '$this->password', '$this->name', '$this->vehicle')";
            $this->output .= '<script>alert("Data has been inserted");</script>';
            if($conn->query($query))
            {
                $select_query = "SELECT * FROM users ORDER BY id";
                $result = $conn->query($select_query);
                $this->output .= '
                <table class="table table-bordered" style="background-color:rgba(0,10,200,0.1);border:2px solid purple;">  
                <tr style="border:1px solid purple;">  
                    <th width="15%" style="border:1px solid purple;"><p style="text-align:center;">Customer ID</p></th>  
                    <th width="40%" style="border:1px solid purple;"><p style="text-align:center;">Customer Name</p></th>  
                    <th width="15%" style="border:1px solid purple;"><p style="text-align:center;">View</p></th>   
                    <th width="15%" style="border:1px solid purple;"><p style="text-align:center;">Edit</p></th> 
                    <th width="15%" style="border:1px solid purple;"><p style="text-align:center;">Delete</p></th>  
                </tr> '
                ;
                while($row = $result->fetch_array())
                {
                    $this->output .= '
                        <tr style="border:1px solid purple;"> 
                            <td style="text-align:center;border:1px solid purple;">'.$row["id"].'</td> 
                            <td style="text-align:center;border:1px solid purple;">'.$row["name"].'</td>
                            <td style="border:1px solid purple;"><input type="button" name="view" value="view" id="'.$row["id"].'" class="btn btn-info btn-xs view_data" 
                            style="margin-left:20%;width:60px;font-size:13px;background-color:rgba(116,10,110,0.5);border:1px solid purple;"/></td> 
                            <td style="border:1px solid purple;"><input type="button" name="edit" value="Edit" id="'.$row["id"].'" class="btn btn-info btn-xs edit_data" 
                            style="margin-left:20%;width:60px;font-size:13px;background-color:rgba(116,10,110,0.5);border:1px solid purple;"/></td> 
                            <td style="border:1px solid purple;"><input type="button" name="delete" value="Delete" id="'.$row["id"].'" class="btn btn-info btn-xs delete_data" 
                            style="margin-left:20%;width:60px;font-size:13px;background-color:rgba(116,10,110,0.5);border:1px solid purple;"/></td>  
                        </tr> 
                    ';
                }
                $this->output .= '</table>';
            }
            echo $this->output;
        }
    }
}
$conn = new Database("localhost","root","ksmmtn921112","obd2");
$link = $conn->connect();
$i = new insert();
$i->add($link);
?>
