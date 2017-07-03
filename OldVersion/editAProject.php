<!DOCTYPE html>
<?php
include ('dbconnect.php');
?>
<html>
<head>
	<title>Edit Your Project</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale = 1">
	<title>Bootstrap Tutorial</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script type="text/javascript">

		var counter1=counter2=counter3=counter4=0;
		var limit = 4;
		function addTask(dynamicDiv){
			if (counter1 == limit)  {
				alert("You have reached the limit of adding " + counter1 + " phases");
			}
			else {
				var newEntryRow = document.createElement('div');
				newEntryRow.innerHTML = "<br><strong>Entry " + (counter1 + 1) + "</strong><br>Phase Name:&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' name='phaseName[]'> <br>Task Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' name='taskName[]'><br>Estimated Cost: <input type='text' name='taskEstimate[]'><br>Estimated Time: <input type='text' name='taskTimeEstimate[]'><br>";
				document.getElementById(dynamicDiv).appendChild(newEntryRow);
				counter1++;
			}
		}

		function completeTask(dynamicDiv){
			if (counter2==limit){
				alert("You have reached the limit of completing " + counter2 + " Tasks");
			}else{
				var newEntryRow = document.createElement('div');
				newEntryRow.innerHTML = "<strong>Entry " + (counter2 + 1) + " <br>Phase Name:&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' name='phaseName[]'><br>Task Name: <input type='text' name='taskName[]'><br>Total Cost: &nbsp;&nbsp<input type='text' name='taskCost[]'><br>Total Time: &nbsp;&nbsp<input type='text' name='taskTime[]'><br>";
				document.getElementById(dynamicDiv).appendChild(newEntryRow);
				counter2++;
			}
		}

		function deleteTask(dynamicDiv){
			if (counter3==limit){
				alert("You have reached the limit of completing " + counter3 + " Tasks");
			}else{
				var newEntryRow = document.createElement('div');
				newEntryRow.innerHTML = "<strong>Entry " + (counter3 + 1) + " <br>Phase Name:&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' name='phaseName[]'><br>Task Name: <input type='text' name='taskName[]'>";
				document.getElementById(dynamicDiv).appendChild(newEntryRow);
				counter3++;
			}
		}

	</script>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				<h3><a href="#firstColContent" data-toggle="collapse">Add a task to an existing project</a></h3>
				<div id="firstColContent" class="collapse in">
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<strong>Project ID</strong>:<br>
						<input type="text" name="pIDa"><br>
						<div id=addTask></div><br>
						<input type="button" value="Click to add a task" onClick="addTask('addTask');"><br><br>
						<input type="submit" name="add" value="Submit"><br>
					</form>
				</div>
			</div>



			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				<h3><a href="#secondColContent" data-toggle="collapse">Complete a task for an existing project</a></h3>
				<div id="secondColContent" class="collapse in">
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<strong>Project ID</strong>:<br>
						<input type="text" name="pIDc"><br>
						<div id=completeTask></div><br>
						<input type="button" value="Click to add a task" onClick="completeTask('completeTask');"><br><br>
						<input type="submit" name="complete" value="Submit">
					</form>
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				<h3><a href="#thirdColContent" data-toggle="collapse">Delete a project</a></h3>
				<div id="thirdColContent" class="collapse in">
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<strong>Project ID</strong>:<br>
						<input type="text" name="pIDd"><br>
						<div id=deleteProject></div><br>
						<input type="submit" name="delete" value="Submit">
					</form>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				<h3><a href="#fourthColContent" data-toggle="collapse">Delete a task from a project</a></h3>
				<div id="fourthColContent" class="collapse in">
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<strong>Project ID</strong>:<br>
						<input type="text" name="pIDdt"><br>
						<div id=deleteTask></div><br>
						<input type="button" value="Click to add a task" onClick="deleteTask('deleteTask');"><br><br>
						<input type="submit" name="deleteT" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php 


	if($_SERVER["REQUEST_METHOD"] == "POST"){

		if (isset($_POST['add'])){
			if(empty($_POST['pIDa'])){
				exit("Project ID is required");
			}else{
				$projectID=test_input($_POST['pIDa']);
				$result=mysqli_query($dbconnect,"select * from Project where ID='$projectID'");
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$count = mysqli_num_rows($result);
				if($count>0){
					if (empty($_POST['phaseName']) || empty($_POST['taskName']) || empty($_POST['taskEstimate']) || empty($_POST['taskTimeEstimate'])){
						exit("One of the required fields are empty.");
					}else{
						$phaseName=$_POST['phaseName'];
						$taskName=$_POST['taskName'];
						$taskEstimate=$_POST['taskEstimate'];
						$taskTimeEstimate=$_POST['taskTimeEstimate'];
						$numTasks= count($taskName);
						for ($i=0; $i <$numTasks; $i++){
							if ($phaseName[$i]==''||$taskName[$i]==''||$taskEstimate[$i]==''|| $taskTimeEstimate[$i]==''){
								exit("One of your fields for phase planning is left empty");
							}else{
								$sql= "select * from Task where ProjectID='$projectID' and PhaseName='$phaseName[$i]' and Name='$taskName[$i]'";
								if(taskCheck($sql)>0){
									exit("Task <strong>".$taskName[$i]."</strong> already exists in <strong>".$projectID."</strong> Phase <strong>".$phaseName[$i]."</strong>.");
								}else{
									$sql= "INSERT INTO Task VALUES ( 0,0,'$taskEstimate[$i]', 0, '$taskTimeEstimate[$i]', '$taskName[$i]','$phaseName[$i]', '$projectID')";
									if ($dbconnect->query($sql) === TRUE) {
										echo "New record created successfully";
									} else {
										echo "Error: " . $sql . "<br>" . $dbconnect->error;
									}
								}
							}
						}
					}
				}else{
					exit("Project ID Does not exists");
				}
			}
		}else if (isset($_POST['complete'])){
			if(empty($_POST['pIDc'])){
				exit("Project ID is required");
			}else{
				$projectID=test_input($_POST['pIDc']);
				$result=mysqli_query($dbconnect,"select * from Project where ID='$projectID'");
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$count = mysqli_num_rows($result);
				if($count>0){
					if (empty($_POST['phaseName']) || empty($_POST['taskName']) || empty($_POST['taskCost']) || empty($_POST['taskTime'])){
						exit("One the required fields are empty.this");
					}else{
						$taskName=$_POST['taskName'];
						$taskCost=$_POST['taskCost'];
						$taskTime=$_POST['taskTime'];
						$phaseName=$_POST['phaseName'];
						$numTasks= count($taskName);
						for ($i=0; $i <$numTasks; $i++){
							if ($taskName[$i]==''||$taskCost[$i]==''|| $taskTime[$i]=='' || $phaseName[$i]==''){
								exit("One of your fields for phase planning is left empty.");
							}else{
								$sql= "select * from Task where ProjectID='$projectID' and PhaseName='$phaseName[$i]' and Name='$taskName[$i]' and status=1";
								if (taskCheck($sql)>0){
									exit("Task ".$taskName[$i]." is already been completed");
								}else{
									$sql= "UPDATE Task SET Status=1, Cost='$taskCost[$i]', ActualTime='$taskTime[$i]' WHERE ProjectID='$projectID'  and PhaseName='$phaseName[$i]' and Name='$taskName[$i]'";
									if ($dbconnect->query($sql) === TRUE) {
										echo "Record updated successfully";
									} else {
										echo "Error updating record: " . $dbconnect->error;
									}
								}
							}
						}
					}
				}else{
					exit("Project ID Does not exists");
				}
			}
		}else if(isset($_POST['delete'])){
			if(empty($_POST['pIDd'])){
				exit("Project ID is required");
			}else{
				$projectID=test_input($_POST['pIDd']);
				$result=mysqli_query($dbconnect,"select * from Project where ID='$projectID'");
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$count = mysqli_num_rows($result);
				if ($count>0){
					$sql="DELETE FROM Project where ID='$projectID'";
					if ($dbconnect->query($sql) === TRUE) {
						echo "Record deleted successfully";
					} else {
						echo "Error deleting record: " . $dbconnect->error;
					}
				}else{
					exit("Project ID Does not exist.");
				}
			}
		}else{
			if( empty($_POST['pIDdt'])){
				exit("Project ID is required");
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
						exit("One of your required fields are empty.");
					}else{
						for ($i=0; $i <$numTasks; $i++){
							if ($taskName[$i]==''|| $phaseName[$i]==''){
								exit("One of your fields is left empty.");
							}else{
								$sql="select * from Task where ProjectID='$projectID' and PhaseName='$phaseName[$i]' and Name='$taskName[$i]'";
								if (taskCheck($sql)>0){
									$sql="DELETE FROM Task where ProjectID='$projectID' AND Name='$taskName[$i]' AND PhaseName='$phaseName[$i]'";
									if ($dbconnect->query($sql) === TRUE) {
										echo "Record deleted successfully";
									} else {
										echo "Error deleting record: " . $dbconnect->error;
									}
								}else{
									exit("Project Task does not exist");
								}
							}
						}
					}

				}else{
					exit("Project ID Doesn not exist.");
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>