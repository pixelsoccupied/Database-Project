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
		<title>Edit Your Project</title>
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
			margin:auto;
			padding: 10px;
		}
	</style>
	<script type="text/javascript">

		var counter1=counter2=counter3=counter4=0;
		var limit = 4;
		function addTask(dynamicDiv){
			if (counter1 == limit)  {
				alert("You have reached the limit of adding " + counter1 + " phases");
			}
			else {
				var newEntryRow = document.createElement('div');
				newEntryRow.innerHTML = "<br><strong>Entry " + (counter1 + 1) + "</strong><br>Phase Name:<input type='text' class='form-control' name='phaseName[]'> <br>Task <input type='text'class='form-control' name='taskName[]'><br>Estimated Cost: <input type='text' class='form-control'name='taskEstimate[]'><br>Estimated Time: <input type='text' class='form-control' name='taskTimeEstimate[]'><br>";
				document.getElementById(dynamicDiv).appendChild(newEntryRow);
				counter1++;
			}
		}

		function completeTask(dynamicDiv){
			if (counter2==limit){
				alert("You have reached the limit of completing " + counter2 + " Tasks");
			}else{
				var newEntryRow = document.createElement('div');
				newEntryRow.innerHTML = "<strong>Entry " + (counter2 + 1) + " <br>Phase Name:&nbsp;&nbsp;&nbsp;&nbsp; <input type='text'class='form-control' name='phaseName[]'><br>Task Name: <input type='text'class='form-control' name='taskName[]'><br>Total Cost: &nbsp;&nbsp<input type='text'class='form-control'name='taskCost[]'><br>Total Time: &nbsp;&nbsp<input type='text' class='form-control' name='taskTime[]'><br>";
				document.getElementById(dynamicDiv).appendChild(newEntryRow);
				counter2++;
			}
		}

		function deleteTask(dynamicDiv){
			if (counter3==limit){
				alert("You have reached the limit of completing " + counter3 + " Tasks");
			}else{
				var newEntryRow = document.createElement('div');
				newEntryRow.innerHTML = "<strong>Entry " + (counter3 + 1) + " <br>Phase Name:&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' class='form-control' name='phaseName[]'><br>Task Name: <input type='text' class='form-control' name='taskName[]'>";
				document.getElementById(dynamicDiv).appendChild(newEntryRow);
				counter3++;
			}
		}

	</script>
</head>
<body>
	<div class="topnav">
		<a href="employee.php">Home</a>
		<a href="main.php">Log out</a>
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
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-4">
				<h3><strong>Add a task to an existing project</strong></h3>
				<div id="firstColContent" class="collapse in">
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<strong>Project ID</strong>:<br>
						<input type="text" class="form-control" name="pIDa"><br>
						<div id=addTask></div><br>
						<input type="button" value="Click to add a task" onClick="addTask('addTask');"><br><br>
						<input type="submit" class="btn btn-primary"  name="add" value="Submit"><br>
					</form>
				</div>
			</div>



			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
			<h3><strong>Complete a task for an existing project</strong></h3>
				<div id="secondColContent" class="collapse in">
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<strong>Project ID</strong>:<br>
						<input type="text" class="form-control" name="pIDc"><br>
						<div id=completeTask></div><br>
						<input type="button" value="Click to add a task" onClick="completeTask('completeTask');"><br><br>
						<input type="submit" class="btn btn-primary"  name="complete" value="Submit">
					</form>
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				<h3><strong>Delete a project</strong></h3>
				<div id="thirdColContent" class="collapse in">
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<strong>Project ID</strong>:<br>
						<input type="text" class="form-control" name="pIDd"><br>
						<div id=deleteProject></div><br>
						<input type="submit" class="btn btn-primary" name="delete" value="Submit">
					</form>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				<h3><strong>Delete a task from a project</strong></h3>
				<div id="fourthColContent" class="collapse in">
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<strong>Project ID</strong>:<br>
						<input type="text" class="form-control" name="pIDdt"><br>
						<div id=deleteTask></div><br>
						<input type="button" value="Click to add a task" onClick="deleteTask('deleteTask');"><br><br>
						<input type="submit" class="btn btn-primary" name="deleteT" value="Submit">
					</form>
				</div>
			</div>
		</div>
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

	if (isset($_POST['add'])){
		if(empty($_POST['pIDa'])){
			exit("<div class=container>Project ID is required</div>");
		}else{
			$projectID=test_input($_POST['pIDa']);
			$result=mysqli_query($dbconnect,"select * from Project where ID='$projectID'");
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);
			if($count>0){
				if (empty($_POST['phaseName']) || empty($_POST['taskName']) || empty($_POST['taskEstimate']) || empty($_POST['taskTimeEstimate'])){
					exit("<div class = container>One of the required fields are empty.</div>");
				}else{
					$phaseName=$_POST['phaseName'];
					$taskName=$_POST['taskName'];
					$taskEstimate=$_POST['taskEstimate'];
					$taskTimeEstimate=$_POST['taskTimeEstimate'];
					$numTasks= count($taskName);
					for ($i=0; $i <$numTasks; $i++){
						if ($phaseName[$i]==''||$taskName[$i]==''||$taskEstimate[$i]==''|| $taskTimeEstimate[$i]==''){
							exit("<div class = container>One of your fields for phase planning is left empty</div>");
						}else{
							$sql= "select * from Task where ProjectID='$projectID' and PhaseName='$phaseName[$i]' and Name='$taskName[$i]'";
							if(taskCheck($sql)>0){
								exit("Task <strong>".$taskName[$i]."</strong> already exists in <strong>".$projectID."</strong> Phase <strong>".$phaseName[$i]."</strong>.");
							}else{
								$sql= "INSERT INTO Task VALUES ( 0,0,'$taskEstimate[$i]', 0, '$taskTimeEstimate[$i]', '$taskName[$i]','$phaseName[$i]', '$projectID')";
								if ($dbconnect->query($sql) === TRUE) {
									echo "<div class = container>New record created successfully</div>";
								} else {
									echo "Error: " . $sql . "<br>" . $dbconnect->error;
								}
							}
						}
					}
				}
			}else{
				exit("<div class = container>Project ID Does not exists</div>");
			}
		}
	}else if (isset($_POST['complete'])){
		if(empty($_POST['pIDc'])){
			exit("<div class = container>Project ID is required</div>");
		}else{
			$projectID=test_input($_POST['pIDc']);
			$result=mysqli_query($dbconnect,"select * from Project where ID='$projectID'");
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);
			if($count>0){
				if (empty($_POST['phaseName']) || empty($_POST['taskName']) || empty($_POST['taskCost']) || empty($_POST['taskTime'])){
					exit("<div class = container>One the required fields are empty.this</div>");
				}else{
					$taskName=$_POST['taskName'];
					$taskCost=$_POST['taskCost'];
					$taskTime=$_POST['taskTime'];
					$phaseName=$_POST['phaseName'];
					$numTasks= count($taskName);
					for ($i=0; $i <$numTasks; $i++){
						if ($taskName[$i]==''||$taskCost[$i]==''|| $taskTime[$i]=='' || $phaseName[$i]==''){
							exit("<div class = container>One of your fields for phase planning is left empty.</div>");
						}else{
							$sql= "select * from Task where ProjectID='$projectID' and PhaseName='$phaseName[$i]' and Name='$taskName[$i]' and status=1";
							if (taskCheck($sql)>0){
								exit("<div class=container>Task ".$taskName[$i]." is already been completed</div>");
							}else{
								$sql= "UPDATE Task SET Status=1, Cost='$taskCost[$i]', ActualTime='$taskTime[$i]' WHERE ProjectID='$projectID'  and PhaseName='$phaseName[$i]' and Name='$taskName[$i]'";
								if ($dbconnect->query($sql) === TRUE) {
									echo "<div class = container>Record updated successfully</div>";
								} else {
									echo "Error updating record: " . $dbconnect->error;
								}
							}
						}
					}
				}
			}else{
				exit("<div class=container>Project ID Does not exists<div>");
			}
		}
	}else if(isset($_POST['delete'])){
		if(empty($_POST['pIDd'])){
			exit("<div class=container> Project ID is required </div>");
		}else{
			$projectID=test_input($_POST['pIDd']);
			$result=mysqli_query($dbconnect,"select * from Project where ID='$projectID'");
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);
			if ($count>0){
				$sql="DELETE FROM Project where ID='$projectID'";
				if ($dbconnect->query($sql) === TRUE) {
					echo "<Div class = container>Record deleted successfully</div>";
				} else {
					echo "Error deleting record: " . $dbconnect->error;
				}
			}else{
				exit("<div class=container>Project ID Does not exist.</div>");
			}
		}
	}else{
		if( empty($_POST['pIDdt'])){
			exit("<div class=container>Project ID is required</div>");
		}else{
			$projectID=test_input($_POST['pIDdt']);
			$result=mysqli_query($dbconnect,"select * from Project where ID='$projectID'");
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);
			if ($count>0){

				$taskName=$_POST['taskName'];
				$phaseName=$_POST['phaseName'];
				$numTasks= count($taskName);

				if (empty($_POST['phaseName']) || empty($_POST['taskName'])){
					exit("<div class=container>One of your required fields are empty.</div>");
				}else{
					for ($i=0; $i <$numTasks; $i++){
						if ($taskName[$i]==''|| $phaseName[$i]==''){
							exit("<div class=container>One of your fields is left empty.</div>");
						}else{
							$sql="select * from Task where ProjectID='$projectID' and PhaseName='$phaseName[$i]' and Name='$taskName[$i]'";
							if (taskCheck($sql)>0){
								$sql="DELETE FROM Task where ProjectID='$projectID' AND Name='$taskName[$i]' AND PhaseName='$phaseName[$i]'";
								if ($dbconnect->query($sql) === TRUE) {
									echo "<div class=container>Record deleted successfully</div>";
								} else {
									echo "Error deleting record: " . $dbconnect->error;
								}
							}else{
								exit("<div class=container>Project Task does not exist</div>");
							}
						}
					}
				}

			}else{
				exit("<div class=container>Project ID Doesn not exist.</div>");
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

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

</body>
</html> 