<?php
session_start();
include("dbconnect.php");
$temp = $_SESSION['myusername'];
echo "Logged in as #" . $temp . "<br>";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	  $optionSelected = mysqli_real_escape_string($dbconnect,$_POST['optionSelected']);
      //$ID = mysqli_real_escape_string($dbconnect,$_POST['ID']); 
     $sql = "INSERT INTO Orders (EmployeeID, ItemID )VALUES ('$temp','$optionSelected')";


    $result = mysqli_query($dbconnect,$sql);
     if ($result === TRUE) 
	{
		echo "Record updated successfully!<br>";
	} 
	else 
	{
		echo "Error updating record: " . $conn->error."<br>";
	}
 
	} 
    
?>


<html>

<head>
<title>Update Database</title>
</head>
<body>


<br><b>Add Task</b>
<form action="" method="post">

	

<p>Select from the list of items to order: </p>
<select name = optionSelected>
    
    <option value= 321> Window</option>
    <option value= 322> Camera </option> //lights
    <option value= 323> Carpet </option>
    <option value= 324> Floorboard </option>
    <option value= 325> Wire </option>
    <option value=326> Door </option>
    <option value=327>  Light Bulb </option>
    <option value= 328 > Toilet </option>
    <option value=329> Sink </option>
        <option value=330> HVAC System </option>
  
</select>





    <input type="submit" name="submit" value="Update" />
</form>


</body>
</html>