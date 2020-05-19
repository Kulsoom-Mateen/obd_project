<?php
require "connection_database.php";
// require "config.php";
class login{
    // public function __construct($conn)
    // {
    //     $this->db = $conn;
    // }
    public function abc($conn){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->name = $_POST["name"];
            $this->pass = $_POST["password"];
            $name1 = $this->test_input($this->name);
            $pass1 = $this->test_input($this->pass);
            $sql="select * from admin where username='".$name1."' AND password='".$pass1."' limit 1 ";
            $result=$conn->query($sql);
            return $this->extra($conn,$name1,$pass1,$result);
        }
    }
    private function test_input($data) {
        $this->data = trim($data);
        $this->data = stripslashes($data);
        $this->data = htmlspecialchars($data);
        return $this->data;
    }
    public function extra($conn,$name1,$pass1,$result){
        if(strlen($pass1)<6 and !empty($pass1))
        {
            return "Password should be 6 characters in length";
        }
        else{
            if($result->num_rows==1){
                header("location: dashboard.php");
            }
            else{
                if(empty($name1) OR empty($pass1)){
                    return "Username and password are required";
                }
                else{
                    return "You have entered wrong username or password";
                }
            }
        }
    }
}
$conn = new Database("localhost","root","ksmmtn921112","obd2");
$link = $conn->connect();
$l= new login();
$invalid = $l->abc($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBD2 web app</title>
    
    <style>
    body ,html{
    height:100%;
    margin:0;
    }

    .bg {   
    height: 100%; 
    position:relative;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    width:100%;
    float:right;
    min-height:657px;
    max-height:80px;
    }

    .login-area {
         width:100%
    }

    .form-area {
    position: absolute;
    font-family: Tahoma, sans-serif;
    top: 51%;
    left: 50.7%;
    transform: translate(-50%, -50%); 
    width: 100%;
    height: 92%;
    box-sizing: border-box;
    background: rgba(110 , 10 , 150 , 0.8)   ;
    padding: 103px;
    min-height:500px;
    max-width :500px;
    /* min-width:200px;  */
    }

    h3 {
    margin: 20px;
    padding: 0 0px 20px;
    font-weight: bold;
    color: #ffffff;
    text-align: center;
    font-size: 20px
    }

    .form-area p {
    margin: 10;
    padding: 10;
    font-weight: bold;
    color: #ffffff;
    }

    .form-area input[type=text],
    .form-area input[type=password] {
    border: none;
    border-bottom: 1px solid #ffffff;
    background-color: transparent; 
    outline: none;
    height: 40px;
    width: 100%;
    color: #ffffff;
    display: 16px;
    }

    ::placeholder {
    color: #ffffff
    }

    .form-area a {
    color: #ffffff;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    padding: 0px 5px 7px 5px;
    }

    .join {
    text-align: right;
    float: right;
    margin-top: 40px;
    }

    .forgot {
    text-align: left;
    float: left;
    margin-top: 40px;
    }

    .form-area input[type="text"]:focus,
    .form-area input[type="password"]:focus {
    width: 200px;
    }
    .error{
    font-size:12px;
    color:white;
    margin-left:auto;
    text-align:center;
    }
    .button{
    font-size: 15px;
    font-family: sans-serif;
    width: 100px;
    background-color: white;
    display: block;
    margin: 30px auto;
    margin-top:20px;
    text-align: center;
    border: 2px solid purple;
    padding: 10px 10px;
    outline: none;
    color: purple;
    border-radius: 100px;
    transition: 0.5s;
    cursor: pointer;
    font-weight: bold;
    }
    .button:hover {
    background-color: purple;
    color: #ffffff;
    border: 2px solid white;
    font-weight: bold;
    width: 120px;
    }
    </style>
</head>

<body>
    <header>
    </header>
    <main>
        <div>
            <img class="bg" src="meter5.jpg" alt="car_img" style="height:700px;">
        </div>
        <div class="form-area">
            <b><h1 style="color:white;width:100%;margin-top:-65px;margin-bottom:50px;margin-left:100px;">OBD2</h1></b>
            <h3>Login Form</h3>
            <form class="box" method="POST" action="    " style="width:100%;height:20px;">
                <br>
                <p>User Name</p>
                <input type="text" name="name" id="" placeholder="Username" ><br><br>
                <p>Password</p>
                <input type="password" name="password" id="" placeholder="Password" ><br><br>
                <span class="error"><?php echo $invalid;?></span>
                <button class="button" type="submit" name="submit">Login</button>
                <a class="forgot" href="forgot_password1.php" style="text-decoration:underline;float:left;margin-left:80px;margin-top: 15px;"
                    target="blank">Forgot password</a>
                <!-- </h6> -->
                <!-- <a class="join" href="registration.php" style="text-align: right;float:right;margin-top: 15px;"
                    target="blank">Not registered,join now</a></h6> -->
            </form>
        </div>
    </main>
</body>
</html>