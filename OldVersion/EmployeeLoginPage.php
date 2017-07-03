<?php
 include("dbconnect.php");
   session_start();
   
   //<p>Enter your ID:
//<input type= "ID" name="ID" size="30" value=" " />
//</p>
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($dbconnect,$_POST['ID']);
      $mypassword = mysqli_real_escape_string($dbconnect,$_POST['password']); 
      
      $sql = "SELECT * FROM Employee WHERE ID = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($dbconnect,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1) {
         $_SESSION['myusername'] = $myusername;
         
        header("location: employee.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>

<style>
form {
    border: 1px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 3px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: green;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.5;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
   
   <body bgcolor = "#FFFFFF">
   
      <div align = "center">
         <div style = "width:500; border: solid 1px #333333; " align = "center">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Employee Login</b></div>
            
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>USER ID  :</label><input type = "text" name = "ID" class = "input"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "input" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               
               </form>
               
               <div style = "font-size:15px; color:#cc0000; margin-top:10px"></div>
               
            </div>
            
         </div>
         
      </div>


   </body>
</html>