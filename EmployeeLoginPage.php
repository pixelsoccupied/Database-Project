<?php
include("dbconnect.php");
session_start();

   //<p>Enter your ID:
//<input type= "ID" name="ID" size="30" value=" " />
//</p>
if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 

  $myusername = mysqli_real_escape_string($dbconnect,$_POST['ID']);
  $mypassword = mysqli_real_escape_string($dbconnect,$_POST['password']); 

  $sql = "SELECT * FROM Employee WHERE ID = '$myusername' and password = '$mypassword'";
  $result = mysqli_query($dbconnect,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $active = $row['active'];

  $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

  if($count == 1) {
   $_SESSION['myusername'] = $myusername;

   header("location: employee.php");
 }else {
   $error = "Your Login Name or Password is invalid";
 }
}
?>
<html>
<head>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width = device-width, initial-scale = 1">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <style>
    body {
      font-family: "Lato", sans-serif;
      transition: background-color .5s;
    }
    .sidenav {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #111;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }
    .sidenav a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 18px;
      color: #f2f2f2;
      display: block;
      transition: 0.3s;
    }
    .sidenav a:hover, .offcanvas a:focus{
      color: #f1f1f1;
    }

    .sidenav .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }
    #main {
      transition: margin-left .5s;
      padding: 16px;
      padding-left: 18px;
      padding-right: 18px;
    }
    #main h2{
      color: black;
      font-weight: bold;
    }
    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }
    .topnav {
      background-color: #333;
      overflow: hidden;
    }
    /* Style the links inside the navigation bar */
    .topnav a {
      float: right;
      display: block;
      color: #f2f2f2;
      text-align: center;
      padding: 18px 16px;
      text-decoration: none;
      font-size: 17px;
    }


    /* Change the color of links on hover */
    .topnav a:hover {
      background-color: #ddd;
      color: black;
    }

    /* Add a color to the active/current link */
    .topnav a.active {
      background-color: #4CAF50;
      color: white;
    }
    .topnav h2{
      margin: 0;
      padding-left: 16px;
      padding-bottom: 14px;
      padding-top: 14px;
      color: #f2f2f2;
    }
    .container{
      margin: auto;
    }
  </style>
</head>
<body>
  <div class="topnav">
    <a href="Main.php">Main Page</a>
    <a href="AboutUS.PHP">About Us</a>
    <h2>Damavand</h2>
  </div>


  <div id="main">
  </div>
  <div class=container>


    <div align = "center">
     <div style = "width:500; border: solid 1px #333333; " align = "center">
      <div style = "background-color:#333333; color:#FFFFFF; padding:5px;"><b>Employee Login</b></div>

      <div style = "margin:30px">

       <form action = "" method = "post">
        <label>User ID  :</label><input type = "text" class="form-control" name = "ID" class = "input"/><br />
        <label>Password  :</label><input type = "password"  class="form-control" name = "password" class = "input" /><br/>
        <input type = "submit"  class="btn-lg btn-primary" value = " Submit "/><br />

      </form>

       <div style = "font-size:15px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

    </div>

  </div>

</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>
</html> 