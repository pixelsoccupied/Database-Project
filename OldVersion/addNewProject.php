<!DOCTYPE html>
<?php
include ('dbconnect.php');
?>
<html>
<head>
	<title>Add a new project</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale = 1">
	<title>Bootstrap Tutorial</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<script type="text/javascript">

		var counter1=counter2=counter3=counter4=0;
		var limit = 4;
		function phaseOne(dynamicDiv){
			if (counter1 == limit)  {
				alert("You have reached the limit of adding " + counter1 + " phases");
			}
			else {
				var newEntryRow = document.createElement('div');
				newEntryRow.innerHTML = "<strong>Entry " + (counter1 + 1) + "</strong> <br>Task Name: <input type='text' name='phaseOneTask[]'><br>Estimated Cost: <input type='text' name='phaseOneEstimate[]'><br>Estimated Time: <input type='text' name='phaseOneTimeEstimate[]'>";
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
				newEntryRow.innerHTML = "<strong>Entry " + (counter2 + 1) + "</strong> <br>Task Name: <input type='text' name='phaseTwoTask[]'><br>Estimated Cost: <input type='text' name='phaseTwoEstimate[]'><br>Estimated Time: <input type='text' name='phaseTwoTimeEstimate[]'>";
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
				newEntryRow.innerHTML = "<strong>Entry " + (counter3 + 1) + "</strong> <br>Task Name: <input type='text' name='phaseThreeTask[]'><br>Estimated Cost: <input type='text' name='phaseThreeEstimate[]'><br>Estimated Time: <input type='text' name='phaseThreeTimeEstimate[]'>";
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
				newEntryRow.innerHTML = "<strong>Entry " + (counter4 + 1) + "</strong> <br>Task Name: <input type='text' name='phaseFourTask[]'><br>Estimated Cost: <input type='text' name='phaseFourEstimate[]'><br>Estimated Time: <input type='text' name='phaseFourTimeEstimate[]'>";
				document.getElementById(dynamicDiv).appendChild(newEntryRow);
				counter4++;
			}
		}

	</script>
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h3>Welcome !</h3>
		</div>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class=row>
				<div class="col-lg-3 col-md-6 col-sm-8 col-xs-12">
					<strong>Project ID*</strong>:<br>
					<input type="text" name="pID"><br>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-8 col-xs-12">
					<label>Allocated Amount*</label>:<br>
					<input type="text" name="allocatedAmount"><br>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-8 col-xs-12">	
					<label>Project Name*</label>:<br>
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
		</div>
	</div>
</div>

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
				echo "Project added to database"<br>;

			} else {
				echo "Error: " . $sql . "<br>" . $dbconnect->error;
			}
		}
	}

	if (empty($_POST['phaseOneTask'])){
		echo "No task added for phase Planning.<br>";
	}else{
		$phaseOneTask=$_POST['phaseOneTask'];
		$phaseOneEstimate=$_POST['phaseOneEstimate'];
		$phaseOneTimeEstimate=$_POST['phaseOneTimeEstimate'];
		$numTasks= count($phaseOneTask);
		for ($i=0; $i <$numTasks; $i++){
			if ($phaseOneTask[$i]==''||$phaseOneEstimate[$i]==''||$phaseOneTimeEstimate==''){
				echo "One of your fields for phase planning is left empty";
				roleBack();
			}else{
				$sql="select * from Task where ProjectID='$projectID' AND Name='$phaseOneTask[$i]'";
				if(taskCheck($sql)>0){
					echo "A duplicate has been found for task ".$phaseOneTask[$i];
					roleBack();
				}else{
					$sql = "INSERT INTO Task VALUES ( 0,0,'$phaseOneEstimate[$i]', 24, '$phaseOneTimeEstimate[$i]', '$phaseOneTask[$i]', 'Planning', '$projectID')";
					failedQueryRoleBack($sql);
				}
			}
		}
	}

	if (empty($_POST['phaseTwoTask'])){
		echo "No task added for phase Construction.<br>";
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
					echo "A duplicate has been found for task ".$phaseTwoTask[$i];
					roleBack();
				}else{
					$sql = "INSERT INTO Task VALUES ( 0,0,'$phaseTwoEstimate[$i]', 24, '$phaseTwoTimeEstimate[$i]', '$phaseTwoTask[$i]', 'Construction', '$projectID')";
					failedQueryRoleBack($sql);
				}
			}
		}
	}

	if (empty($_POST['phaseThreeTask'])){
		echo "No task added for phase Delivery.<br>";
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
		echo "No task added for phase Maintenance.<br>";
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>