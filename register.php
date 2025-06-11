<?php

use Dom\Mysql;

session_start();
include('db.php');


if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"])){
    
        

    $email = $_POST['email'];
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $date_created = 'current_timestamp()';
    $check_username_query = "SELECT * FROM users WHERE username = '$username'";
    $check_username_result = $conn->query($check_username_query);

    // Check for duplicate email
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $check_email_result = $conn->query($check_email_query);

    if ($check_username_result->num_rows > 0) {
           echo "<script>
           alert('Username already taken. Please choose a different one.');
           </script>";
    } elseif ($check_email_result->num_rows > 0) {
           echo "<script>
           alert('Email already taken. Please choose a different one.');
           </script>";
    }else {

        // Insert data into the database
        $sql = "INSERT INTO users (username, email, password) 
                VALUES ('$username', '$email', '$password')";
       
            mysqli_query($conn, $sql);
            mysqli_close($conn);

            header("Location: login.php");
            exit;
    }
    }

   
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>myNotes</title>

</head>
<body>
    <div class="img-container">
    <img src="images/loginIMG.png" >
    </div>
    <div class="login-container">
 <div class="login-form">
    <h1>myNotes</h1>
    <h3>Welcome!</h3>
    <form method="post">
            <label>Username
                <br><input type="text" name="username" autocomplete="off" required><br>
            </label><br>
             <label>Email
                <br><input type="email" name="email" autocomplete="off" required><br>
            </label><br>
            <label>Password
                <br><input type="password" name="password" autocomplete="off" required><br>
            </label><br>
           <br>
            
            <input type="submit" value="Sign in" name="register" class="login-btn">
        </form>
       <section class="register-section"> <p>Already Registered? <a href="login.php">Sign in here</a></p></section>
    </div>
    </div>
</body>
</html>

