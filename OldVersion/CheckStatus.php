<!DOCTYPE html>
<?php
include ('dbconnect.php');
?>
<html>
<head>
	<title>Check Status</title>
</head>
<body>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<div>
			<strong>Project ID</strong>:<br>
			<input type="text" name="pID"><br><br>
		</div>
		<input type="submit" value="Submit">
	</form>
</body>

<?php 

if($_SERVER["REQUEST_METHOD"] == "POST"){

	$projectID=test_input($_POST['pID']);

	$result=mysqli_query($dbconnect,"select * from Project where ID='$projectID'");
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	$PhaseNameArray=array();
	$i=0;
	if($count>0){
		$result=mysqli_query($dbconnect,"select distinct PhaseName from PhaseName");
		if (mysqli_num_rows($result)){
			while($row=mysqli_fetch_assoc($result)){
				$PhaseNameArray[$i]=$row["PhaseName"];
				$i++;
			}
		}else{
			exit("no result");
		}

		echo "<strong>Next phases to be completed: </strong> <br><br>";
		foreach ($PhaseNameArray as $key) {
			
			$result=mysqli_query($dbconnect,"select Name from Task where ProjectID='$projectID' and PhaseName='$key' and status=0");
			//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);
			if($count>0){
				echo "<Strong>Phase ".$key." is incomplete</Strong><br>";
				echo "Incompleted tasks are: <br>";
				while($row = mysqli_fetch_assoc($result)){

					echo 'Task name: '.$row["Name"].'<br>';

				}
			}
		}
	}else{
		exit("Project ID does not exist");
	}	
}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

</html>