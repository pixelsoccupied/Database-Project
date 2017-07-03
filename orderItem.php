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


$ProjectIDarray =array();
$sql= "SELECT ProjectID From WorksFor Where EmployeeID = $EmployeeID";
$result = mysqli_query($dbconnect,$sql);
if (mysqli_num_rows($result)>0){
  $counter=0;
  while($row=mysqli_fetch_assoc($result)){
    $ProjectIDarray[$counter]=$row["ProjectID"];
    $counter++;
  }
}

// collects an array of avaiable phases
$ProjectPhaseArray = array();
$sql ="SELECT * From PhaseName";
$result = mysqli_query($dbconnect,$sql);
if (mysqli_num_rows($result)>0){
  $counter=0;
  while($row=mysqli_fetch_assoc($result)){
    $ProjectPhasearray[$counter]=$row["PhaseName"];
    $counter++;
  }

}

$ProjectTaskArray = array();
$sql ="SELECT * From TaskName";
$result = mysqli_query($dbconnect,$sql);
if (mysqli_num_rows($result)>0){
  $counter=0;
  while($row=mysqli_fetch_assoc($result)){
    $ProjectTaskArray[$counter]=$row["TaskName"];
    $counter++;
  }
}




?>
<html>
<head>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width = device-width, initial-scale = 1">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <title>Update Database</title>
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
   <h2> <?php echo "$EmployeeName";?> !</h2>
   <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span> 
 </div>
 <div class=container>
   <h3> <strong>Place an order here:</strong></h3><br>
   <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <p><Strong>Your avaiable Projects are:</Strong> </p>
      <SELECT class="form-control" name=pID>
        <?php foreach($ProjectIDarray as $key ): echo '<option value="'.$key.'">'.$key.'</option>';endforeach;?>
      </SELECT>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <STRONG><p>Select Phase: </p></STRONG>

      <select class="form-control" name = PhaseName>
        <option value= 'Construction'> Construction </option> 
        <option value='Maintenance'> Maintenance</option>
        <option value= 'Delivery'> Delivery </option>
      </select>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

      <br><Strong><p>Select from the list of items to Tasks:</p></Strong>
      <select class="form-control" name = TaskName>
        <?php foreach($ProjectTaskArray as $key ): echo '<option value="'.$key.'">'.$key.'</option>';endforeach;?>
      </select>

    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <br> <strong><p>Select your Item: </p></strong>
     <select class="form-control" name = ItemName>

      <option value=321> Window </option>
      <option value= 322> Camera </option> //lights
      <option value=323> Carpet </option>
      <option value= 324> Floorboard </option>
      <option value= 325> Wire </option>
      <option value=326> Door </option>
      <option value=327>  Light Bulb </option>
      <option value= 328 > Toilet </option>
      <option value=329> Sink </option>
      <option value=330> HVAC System </option>

    </select>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <br><strong>Number of Items:</strong>
    <input type="text" class="form-control" name="nOItems">
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <br><input type="submit" class="btn btn-primary" name="submit" value="Update" />
  </div>
</form>
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
<?php 

if($_SERVER["REQUEST_METHOD"] == "POST"){

  if (isset($_POST['submit'])){
   $ItemName = mysqli_real_escape_string($dbconnect,$_POST['ItemName']);
   $nOItems = mysqli_real_escape_string($dbconnect,$_POST['nOItems']);
   $TaskName = mysqli_real_escape_string($dbconnect,$_POST['TaskName']);
   $ProjectID = mysqli_real_escape_string($dbconnect,$_POST['pID']);
   $PhaseName = mysqli_real_escape_string($dbconnect,$_POST['PhaseName']);


   $sql = "INSERT INTO Orders (EmployeeID,ItemID) VALUES ('$EmployeeID','$ItemName') ";

   $result = mysqli_query($dbconnect,$sql);
   $sql1= "INSERT into ItemsForTask VALUES ('$nOItems','$ItemName', '$TaskName', '$ProjectID', '$PhaseName')";

   $result1= mysqli_query($dbconnect,$sql1);
   if ($result && $result1===true) 
   {
    echo "Orders updated successfully!<br>";
  } 
  else 
  {
    echo "Error updating record: " . $dbconnect->error."<br>";
  }
}
}
?>
</body>
</html> 