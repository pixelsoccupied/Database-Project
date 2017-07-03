<?php
session_start();
include("dbconnect.php");
$EmployeeID = $_SESSION['myusername'];
$sql= "SELECT Name FROM Employee Where ID='$EmployeeID'";
$result = mysqli_query($dbconnect,$sql);
if (mysqli_num_rows($result)>0){
  $row=mysqli_fetch_assoc($result);
  $EmployeeName=$row["Name"];
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
      margin-top: 20px;
      margin-left: 120px;
      margin-right: 80px;
    }
  </style>
</head>
<body>
  <div class="topnav">
    <a href="employee.php">Home</a>
    <a href="Main.php">Log out</a>
    <a href="AboutUS.PHP">About</a>
    <h2>Damavand</h2>
  </div>

  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="addNewProject.php">Add a new project</a>
    <a href="CheckStatus.php">Check status of project</a>
    <a href="orderItem.php">Order an item for a project</a>
    <a href="editAProject.php">Edit current projects</a>
  </div>

  <div id="main">
   <h2> Welcome <?php echo "$EmployeeName";?> !</h2>
   <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span> 
 </div>
 <div class=container>
 <h2>A complete list of avaiable projects:</h2><br>
   <table class="table table-hover">
    <thead>
     <tr>
      <th>Project ID</th>
      <th>Project Name</th>
      <th>Allocated Amount</th>
    </tr>

  </thead>
  <tbody>
    <?php
    $sql ="SELECT * FROM Project";
    $result = mysqli_query($dbconnect,$sql);
    if (mysqli_num_rows($result)>0){
      $counter=0;
      while($row=mysqli_fetch_assoc($result)){
        ?>
        <tr>
          <td><?php echo $row['ID'];?></td>
          <td><?php echo $row['Name'];?></td>
          <td><?php echo $row['AllocatedAmount'];?></td>
        </tr>
        <?php
      }
    }
    ?>
  </tbody>
</table>
</div>

<script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "260px";
    document.getElementById("main").style.marginLeft = "260px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.body.style.backgroundColor = "white";
  }

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>
</html> 