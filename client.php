<?php
include("dbconnect.php");
session_start();
$clientID= $_SESSION['ClientID'];
$sql= "SELECT Name FROM Client Where ID='$clientID'";
$result = mysqli_query($dbconnect,$sql);
if (mysqli_num_rows($result)>0){
	$row=mysqli_fetch_assoc($result);
	$ClientName=$row["Name"];
}
// getting an array of project names for the clinet logging in 
$ProjectNameArray=array();
$sql= "SELECT Name From Project where Project.ID in (SELECT Owns.ProjectID from Owns where Owns.ClientID='$clientID')";
$result = mysqli_query($dbconnect,$sql);
if (mysqli_num_rows($result)>0){
	$counter=0;
	while($row=mysqli_fetch_assoc($result)){
		$ProjectNameArray[$counter]=$row["Name"];
		$counter++;
	}
}

//getting an array of project ids for the clinet that is logging in
$ProjectIDArray= array();
$sql= "SELECT ID From Project where Project.ID in (SELECT Owns.ProjectID from Owns where Owns.ClientID='$clientID')";
$result = mysqli_query($dbconnect,$sql);
if (mysqli_num_rows($result)>0){
	$counter=0;
	while($row=mysqli_fetch_assoc($result)){
		$ProjectIDArray[$counter]=$row["ID"];
		$counter++;
	}
}

?>
<html>
<head>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale = 1">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<title>Client</title>
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
		.main{
			padding-top:16px;
			padding-bottom: 16px;
			padding-left: 18px;
			padding-right: 18px;
		}

	</style>
</head>
<body>
	<div class="topnav">
		<a href="client.php">Home</a>
		<a href="Main.php">Log out</a>
		<a href="AboutUS.PHP">About</a>
		<h2>Damavand</h2>
	</div>

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="#">Talk to an agent</a>
		<a href="#">Gallery</a>
		<a href="#">Our next projects</a>
	</div>

	<div class="main">
		<h3><Strong>Welcome <?php echo "$ClientName";?></STRONG> </h3>
		<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span> 
	</div>

	<div class=container>
		<div class="jumbotron">
			<h3><Strong>Your avaiable Projects:</Strong></h3> <br>
			<?php 

			$numOfProejects=count($ProjectIDArray);
			if ($numOfProejects>0){
				for ($counter=0; $counter<$numOfProejects ; $counter++) { 
					echo " For <strong>".$ProjectNameArray[$counter]." </Strong> with ID number: <Strong>".$ProjectIDArray[$counter]."</strong> we have:<br><br>";
					$result=mysqli_query($dbconnect,"select Name from Task where ProjectID='$ProjectIDArray[$counter]'and status=1");
					$count = mysqli_num_rows($result);
					if ($count>1){
						while($row = mysqli_fetch_assoc($result)){

							echo 'Task name: <strong>'.$row["Name"].'</strong> Completed.<br>';
						}
					}else{
						echo "No task has been completed yet. Hang in there :).<br>";
					}
					echo "<br>";
				}
			}else{
				echo "<Strong> Our records show that you have no current project with us.</Strong>";
			}
			?>
		</div>
		<div>
			<h4><Strong>Your project financial status:</Strong></h4>
			<?php 
			$Pay=false;
			if (count($ProjectIDArray)>0){
				foreach ($ProjectIDArray as $ProjectID) {
					$sql="SELECT AllocatedAmount From Project WHERE ID='$ProjectID'";
					$result = mysqli_query($dbconnect,$sql);
					$AllocatedAmount=mysqli_fetch_assoc($result);
					$sql = "SELECT Balance FROM Owns WHERE ClientID='$clientID' and ProjectID='$ProjectID'";
					$result = mysqli_query($dbconnect,$sql);
					$Balance=mysqli_fetch_assoc($result);
					$Owes=$AllocatedAmount['AllocatedAmount']-$Balance['Balance'];
					if ($AllocatedAmount['AllocatedAmount']>$Balance['Balance']){
						echo "The remaining balance on project <strong>".$ProjectID." </strong> is:<Strong> ".$Owes."$</Strong><br>";
						$pay=true;
					}else{ 
						echo "All payements have been made for ".$ProjectID;
					}
				}
				if ($pay){
					echo "<br><h5><Strong>Make a payment:<Strong><h5> <br>";
					echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><form method="POST" action="'.$_SERVER['PHP_SELF'].'"><strong>Project ID: </strong><input type="text" class="form-control" name="pID"><br><strong>Amount:</strong> <input type="text" class="form-control" name="Amount"><br><input type="submit" class="btn btn-primary"name="MakePayment" value="Make a payment"></form><div><br<br><br>';
				}
			}else{
				echo "No avaiable projects";
			}
			?>
		</div>

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


		if(empty($_POST['pID']) || empty($_POST['Amount'])){
			exit("Project ID  and Amount is required");
		}else{
			$payment=test_input($_POST['Amount']);
			$pID= test_input($_POST['pID']);
			if ($payment>$Owes || $payment<0){
				exit("Invalid amount!");
			}else{
				$sql = "SELECT Balance FROM Owns WHERE ClientID='$clientID' and ProjectID='$pID'";
				$result = mysqli_query($dbconnect,$sql);
				$B=mysqli_fetch_assoc($result);
				$NewBalance= $payment + $B['Balance'];
				$sql = "UPDATE Owns SET balance = '$NewBalance'";
				$result= mysqli_query($dbconnect,$sql);
				if ($result === true) {
					echo " updated successfully!<br>";
					$sql="SELECT AllocatedAmount From Project WHERE ID='$ProjectID'";
					$result = mysqli_query($dbconnect,$sql);
					$AllocatedAmount=mysqli_fetch_assoc($result);
					$sql = "SELECT Balance FROM Owns WHERE ClientID='$clientID' and ProjectID='$ProjectID'";
					$result = mysqli_query($dbconnect,$sql);
					$Balance=mysqli_fetch_assoc($result);
					$Owes=$AllocatedAmount['AllocatedAmount']-$Balance['Balance'];
					echo "Your new balance is: ". $Owes;

					exit();
				}else{
					echo "Error updating record: " . $dbconnect->error."<br>";
				}
			}
		}
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	?>

</body>
</html> 