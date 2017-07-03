<!DOCTYPE html>
<?php
include("dbconnect.php");
session_start();
$clientID= $_SESSION['ClientID'];
$sql= "SELECT ClientName FROM Client Where ClientID='$clientID'";
$result = mysqli_query($dbconnect,$sql);
if (mysqli_num_rows($result)>0){
	$row=mysqli_fetch_assoc($result);
	$ClientName=$row["ClientName"];
}
// getting an array of project names for the clinet logging in 
$ProjectNameArray=array();
$sql= "SELECT ProjectName From Project where Project.projectID in (SELECT Owns.ProjectID from Owns where Owns.ClientID='$clientID')";
$result = mysqli_query($dbconnect,$sql);
if (mysqli_num_rows($result)>0){
	$counter=0;
	while($row=mysqli_fetch_assoc($result)){
		$ProjectNameArray[$counter]=$row["ProjectName"];
		$counter++;
	}
}

//getting an array of project ids for the clinet that is logging in
$ProjectIDArray= array();
$sql= "SELECT projectID From Project where Project.projectID in (SELECT Owns.ProjectID from Owns where Owns.ClientID='$clientID')";
$result = mysqli_query($dbconnect,$sql);
if (mysqli_num_rows($result)>0){
	$counter=0;
	while($row=mysqli_fetch_assoc($result)){
		$ProjectIDArray[$counter]=$row["projectID"];
		$counter++;
	}
}

?>
<html>
<head>
	<title>Client</title>
	<title>Add a new project</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale = 1">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="page-header">
			<h3>Welcome <?php echo "$ClientName";?> </h3><p>Your avaiable Projects are: <br><?php foreach ($ProjectNameArray as $key) {
				echo "$key<br>";
			} ?>
		</div>
		<div class="jumbotron">
			<?php 

			$numOfProejects=count($ProjectIDArray);
			for ($counter=0; $counter<$numOfProejects ; $counter++) { 
				echo " For project: <strong>".$ProjectNameArray[$counter]." </Strong> with ID number: <Strong>".$ProjectIDArray[$counter]."</strong> we have:<br><br>";
				$result=mysqli_query($dbconnect,"select taskName from Task where projectID='$ProjectIDArray[$counter]'and status=1");
				$count = mysqli_num_rows($result);
				if ($count>1){
					while($row = mysqli_fetch_assoc($result)){

						echo 'Task name: <strong>'.$row["taskName"].'</strong> Completed.<br>';
					}
				}else{
					echo "No task has been completed yet. Hang in there :).<br>";
				}
				echo "<br>";
			}
			?>
		</div>

		<div>
			<p>Your project financial status: </p>
			<?php 
			$Pay=false;
			foreach ($ProjectIDArray as $ProjectID) {
				$sql="SELECT AllocatedAmount From Project WHERE projectID='$ProjectID'";
				$result = mysqli_query($dbconnect,$sql);
				$AllocatedAmount=mysqli_fetch_assoc($result);
				$sql = "SELECT Balance FROM Owns WHERE ClientID='$clientID' and ProjectID='$ProjectID'";
				$result = mysqli_query($dbconnect,$sql);
				$Balance=mysqli_fetch_assoc($result);
				$Owes=$AllocatedAmount['AllocatedAmount']-$Balance['Balance'];
				if ($AllocatedAmount['AllocatedAmount']>$Balance['Balance']){
					echo "The remaining balance on project <strong>".$ProjectID." </strong> is:<br> ".$Owes."$<br>";
					$pay=true;
				}else{ 
					echo "All payements have been made for ".$ProjectID;
				}
			}
			if ($pay){
				echo "<br>Make a payment: <br>";
				echo '<form method="POST" action="'.$_SERVER['PHP_SELF'].'"><strong>Project ID: </strong><input type="text" name="pID"><br><strong>Amount:&nbsp;&nbsp;&nbsp;</strong> <input type="text" name="Amount"><br><br><input type="submit" name="MakePayment" value="Submit"></form>';
			}
			?>
		</div>
	</div>
	<a href=""></a>





	<?php 
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		
		if(empty($_POST['pID'])){
			exit("Project ID is required");
		}else{
			echo "All good ";

		}


	}

	?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>