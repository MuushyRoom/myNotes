<?php
session_start();
include('db.php');


$systemMessage = '';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];


    $res = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();
        if ($password === $user['password']) {
        
            $_SESSION['username'] = $user['username'];
            $_SESSION["user_id"] = $user["user_id"];
        

            header("Location: myNotes.php");
            exit;
        }else{
            
            $systemMessage = 'Invalid Credentials';
        
        }
    }else{
         $systemMessage = 'Account does not exist.';
         
    }
 
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">

    <title>myNotes</title>

</head>
<body>
    <div class="img-container">
    <img src="images/loginIMG.png" >
    </div>
    <div class="login-container">
        
 <div class="login-form">
    <p><?php echo $systemMessage ?></p>
    <h1>myNotes</h1>
    <h3>Sign in to you account</h3>
    <form method="post">
            <label>Username
                <br><input type="text" name="username" autocomplete="off" required><br>
            </label><br>
            <label>Password
                <br><input type="password" name="password" autocomplete="off" required><br>
            </label><br>
            <section class="other-options">
              <div style="white-space:nowrap">
    <input style="height: 50%; width: 50%; margin: -10px;
    padding: 0px" type="checkbox">
     <label for="id1">Remember me</label>
</div>
                
            
                <a href="#">Forgot your password?</a></section><br>
            
            <input type="submit" value="Sign in" name="login" class="login-btn">
        </form>
       <section class="register-section"> <p>Don't have an account? <a href="register.php">Sign up here</a></p></section>
    </div>
    </div>
</body>
</html>
