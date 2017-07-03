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
$Message='';
?>
<html>
<head>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale = 1">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<title>Add a new project</title>
	<script type="text/javascript">

		var counter1=counter2=counter3=counter4=0;
		var limit = 4;
		function phaseOne(dynamicDiv){
			if (counter1 == limit)  {
				alert("You have reached the limit of adding " + counter1 + " phases");
			}
			else {
				var newEntryRow = document.createElement('div');
				newEntryRow.innerHTML = "<strong>Entry " + (counter1 + 1) + "</strong> <br>Task Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='phaseOneTask[]'><br>Estimated Cost: <input type='text' name='phaseOneEstimate[]'><br>Estimated Time: <input type='text' name='phaseOneTimeEstimate[]'>";
				document.getElementById(dynamicDiv).appendChild(newEntryRow);
				counter1++;
			}
		}

		function phaseTwo(dynamicDiv){
			if (counter2 == limit)  {
				alert("You have reached the limit of adding " + counter2 + " phases");
			}
			else {
				var newEntryRow = document.createElement('div');
				newEntryRow.innerHTML = "<strong>Entry " + (counter2 + 1) + "</strong> <br>Task Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='phaseTwoTask[]'><br>Estimated Cost: <input type='text' name='phaseTwoEstimate[]'><br>Estimated Time: <input type='text' name='phaseTwoTimeEstimate[]'>";
				document.getElementById(dynamicDiv).appendChild(newEntryRow);
				counter2++;
			}
		}
		function phaseThree(dynamicDiv){
			if (counter3 == limit)  {
				alert("You have reached the limit of adding " + counter3 + " phases");
			}
			else {
				var newEntryRow = document.createElement('div');
				newEntryRow.innerHTML = "<strong>Entry " + (counter3 + 1) + "</strong> <br>Task Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='phaseThreeTask[]'><br>Estimated Cost: <input type='text' name='phaseThreeEstimate[]'><br>Estimated Time: <input type='text' name='phaseThreeTimeEstimate[]'>";
				document.getElementById(dynamicDiv).appendChild(newEntryRow);
				counter3++;
			}
		}
		function phaseFour(dynamicDiv){
			if (counter4 == limit)  {
				alert("You have reached the limit of adding " + counter4 + " phases");
			}
			else {
				var newEntryRow = document.createElement('div');
				newEntryRow.innerHTML = "<strong>Entry " + (counter4 + 1) + "</strong> <br>Task Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' name='phaseFourTask[]'><br>Estimated Cost: <input type='text' name='phaseFourEstimate[]'><br>Estimated Time: <input type='text' name='phaseFourTimeEstimate[]'>";
				document.getElementById(dynamicDiv).appendChild(newEntryRow);
				counter4++;
			}
		}

	</script>
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
			margin=auto;
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
		<h2><?php echo "$EmployeeName";?></h2>
		<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span> 
	</div>
	<div class=container>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class=row>
				<div class="col-lg-3 col-md-6 col-sm-8 col-xs-12">
					<strong>Project ID</strong>:<br>
					<input type="text" name="pID"><br>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-8 col-xs-12">
					<label>Allocated Amount</label>:<br>
					<input type="text" name="allocatedAmount"><br>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-8 col-xs-12">	
					<label>Project Name</label>:<br>
					<input type="text" name="projectName"><br><br>
				</div>
			</div>
			<div class=row>
				<div class="col-lg-3 col-md-6 col-sm-8 col-xs-12">
					<label>Phase Planning</label>
					<div id= phaseOne>
					</div>
					<input type="button" value="Click to add a task" onClick="phaseOne('phaseOne');"><br><br>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-8 col-xs-12">
					<label>Phase Construction</label>
					<div id= phaseTwo>
					</div>
					<input type="button" value="Click to add a task" onClick="phaseTwo('phaseTwo');"><br><br>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-8 col-xs-12">
					<label>Phase Delivery</label>
					<div id= phaseThree>
					</div>
					<input type="button" value="Click to add a task" onClick="phaseThree('phaseThree');"><br><br>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-8 col-xs-12">
					<label>Phase Maintenance</label>
					<div id= phaseFour>
					</div>
					<input type="button" value="Click to add a task" onClick="phaseFour('phaseFour');"><br><br>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<button type="submit" value="Submit" class="btn btn-primary">Click to add</button><br>
				</div>	
			</form>
			<div class=errorBox><?php echo $Message; ?></div>
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

// one if statment with no else part
		if($_SERVER["REQUEST_METHOD"] == "POST"){
// checking to see if the projectID field is empty
			if (empty($_POST['pID'])){
				exit("Project ID is required");
			}elseif (empty($_POST['projectName'])){
				exit("Project Name is required");
			}elseif (empty($_POST['allocatedAmount'])) {
				exit("Allocated amount is required");
			}else{
				$projectID=test_input($_POST['pID']);
				$projectName=test_input($_POST['projectName']);
				$allocatedAmount=test_input($_POST['allocatedAmount']);
				$result=mysqli_query($dbconnect,"select * from Project where ID='$projectID'");
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$count = mysqli_num_rows($result);
				if($count>0){
					exit("Project ID already exists");
				}else{
					$sql = "INSERT INTO Project (ID,Name, AllocatedAmount) VALUES ('$projectID','$projectName',$allocatedAmount )";
					if ($dbconnect->query($sql) === TRUE) {
					} else {
						echo "Error: " . $sql . "<br>" . $dbconnect->error;
					}
				}
			}

			if (empty($_POST['phaseOneTask'])){
				echo "<Strong>No task added for phase Planning.<Strong><br>";
			}else{
				$phaseOneTask=$_POST['phaseOneTask'];
				$phaseOneEstimate=$_POST['phaseOneEstimate'];
				$phaseOneTimeEstimate=$_POST['phaseOneTimeEstimate'];
				$numTasks= count($phaseOneTask);
				for ($i=0; $i <$numTasks; $i++){
					if ($phaseOneTask[$i]==''||$phaseOneEstimate[$i]==''||$phaseOneTimeEstimate==''){
						echo "<br>One of your fields for phase planning is left empty";
						roleBack();
					}else{
						$sql="select * from Task where ProjectID='$projectID' AND Name='$phaseOneTask[$i]'";
						if(taskCheck($sql)>0){
							echo "<br>A duplicate has been found for task ".$phaseOneTask[$i];
							roleBack();
						}else{
							$sql = "INSERT INTO Task VALUES ( 0,0,'$phaseOneEstimate[$i]', 24, '$phaseOneTimeEstimate[$i]', '$phaseOneTask[$i]', 'Planning', '$projectID')";
							failedQueryRoleBack($sql);
						}
					}
				}
			}

			if (empty($_POST['phaseTwoTask'])){
				echo "<Strong>No task added for phase Construction.</Strong><br>";
			}else{
				$phaseTwoTask=$_POST['phaseTwoTask'];
				$phaseTwoEstimate=$_POST['phaseTwoEstimate'];
				$phaseTwoTimeEstimate=$_POST['phaseTwoTimeEstimate'];
				$numTasks= count($phaseTwoTask);
				for ($i=0; $i <$numTasks; $i++){
					if ($phaseTwoTask[$i]==''||$phaseTwoEstimate[$i]==''||$phaseTwoTimeEstimate[$i]==''){
						echo "One of your fields for phase planning is left empty";
						roleBack();
					}else{
						$sql="select * from Task where ProjectID='$projectID' AND Name='$phaseTwoTask[$i]'";
						if(taskCheck($sql)>0){
							echo "<br>A duplicate has been found for task ".$phaseTwoTask[$i];
							roleBack();
						}else{
							$sql = "INSERT INTO Task VALUES ( 0,0,'$phaseTwoEstimate[$i]', 24, '$phaseTwoTimeEstimate[$i]', '$phaseTwoTask[$i]', 'Construction', '$projectID')";
							failedQueryRoleBack($sql);
						}
					}
				}
			}

			if (empty($_POST['phaseThreeTask'])){
				echo "<strong>No task added for phase Delivery.</strong><br>";
				$noPhaseThree=true;
			}else{
				$phaseThreeTask=$_POST['phaseThreeTask'];
				$phaseThreeEstimate=$_POST['phaseThreeEstimate'];
				$phaseThreeTimeEstimate=$_POST['phaseThreeTimeEstimate'];
				$numTasks= count($phaseThreeTask);
				for ($i=0; $i <$numTasks; $i++){
					if ($phaseThreeTask[$i]==''||$phaseThreeEstimate[$i]==''||$phaseThreeTimeEstimate[$i]==''){
						echo "One of your fields for phase planning is left empty";
						roleBack();
					}else{
						$sql="select * from Task where ProjectID='$projectID' AND Name='$phaseThreeTask[$i]'";
						if(taskCheck($sql)>0){
							echo "A duplicate has been found for task".$phaseThreeTask[$i];
							roleBack();
						}else{
							$sql = "INSERT INTO Task VALUES ( 0,0,'$phaseThreeEstimate[$i]', 24, '$phaseThreeTimeEstimate[$i]', '$phaseThreeTask[$i]', 'Delivery', '$projectID')";
							failedQueryRoleBack($sql);
						}
					}
				}
			}

			if (empty($_POST['phaseFourTask'])){
				echo "<strong>No task added for phase Maintenance.</strong><br>";
			}else{
				$phaseFourTask=$_POST['phaseFourTask'];
				$phaseFourEstimate=$_POST['phaseFourEstimate'];
				$phaseFourTimeEstimate=$_POST['phaseFourTimeEstimate'];
				$numTasks= count($phaseFourTask);
				for ($i=0; $i <$numTasks; $i++){
					if ($phaseFourTask[$i]==''||$phaseFourEstimate[$i]==''||$phaseFourTimeEstimate[$i]==''){
						echo "One of your fields for phase Maintenance is left empty";
						roleBack();
					}else{
						$sql="select * from Task where ProjectID='$projectID' AND Name='$phaseFourTask[$i]'";
						if (taskCheck($sql)>0){
							echo "A duplicate has been found for task".$phaseFourTask[$i];
							roleBack();
						}else{
							$sql = "INSERT INTO Task VALUES ( 0,0,'$phaseFourEstimate[$i]', 24, '$phaseFourTimeEstimate[$i]', '$phaseFourTask[$i]', 'Maintenance', '$projectID')";
							failedQueryRoleBack($sql);
						}
					}
				}
			}
		}

		function taskCheck($sql){

			global $dbconnect;
			$result=mysqli_query($dbconnect,$sql);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);
			return $count;
		}

		function failedQueryRoleBack($sql){
			global $dbconnect;
			global $projectID;
			if ($dbconnect->query($sql) === TRUE) {
			} else {
				$sql = "Delete from Project where ID='$projectID'";
				if ($dbconnect->query($sql) === TRUE) {
					exit("Project has been removed from the data base.Try again<br>");
				}else{
					echo "Error: " . $sql . "<br>" . $dbconnect->error;
				}
				echo "Error: " . $sql . "<br>" . $dbconnect->error;
			}
		}

		function roleBack(){
			global $projectID;
			global $dbconnect;
			$sql = "Delete from Project where ID='$projectID'";
			if ($dbconnect->query($sql) === TRUE) {
				exit("<br><strong>Project ".$projectID." not registered in database.<strong><br>Try again<br>") ;
			}else{
				echo "Error: " . $sql . "<br>" . $dbconnect->error;
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