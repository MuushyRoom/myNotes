<?php 

session_start();
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>myNotes</title>

</head>
<body>
    <div class="img-container">
    <img src="images/loginIMG.png" >
    </div>
    <div class="login-container">
 <div class="login-form">
    <h1>myNotes</h1><br>

           <a href="login.php" class="login-btn">Login</a><br><br>
         <a href="register.php" class="register-btn">Register</a>
       
    </div>
    </div>
</body>
</html>

