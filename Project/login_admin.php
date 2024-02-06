<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-=UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Login</title>
    <style>
        form {
            width: 100%;
            margin: auto; 
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 5px; 
            box-sizing: border-box; 
            margin-bottom: 5px; 
        }
        input[type="submit"] {
            width: 100%; 
            box-sizing: border-box; 
        }
        .field {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php

            include("config.php");
            if(isset($_POST['submit'])){

                $username = mysqli_real_escape_string($con,$_POST['username']);
                $password = mysqli_real_escape_string($con,$_POST['password']);
                
                $result = mysqli_query($con,"SELECT * FROM admin WHERE username='$username' AND password='$password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['username'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['id'] = $row['iD'];
                }else{
                    echo "<div class='message'>
                            <p>Wrong Username or Password. Please try again!</p>
                        </div> <br>";
                    echo "<a href='login_admin.php'><button class='btn'>Go Back</button>";
                }
                if(isset($_SESSION['valid'])){
                    header("Location: admin.php");
                }
            } else{


            ?>
            <header>Admin Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="passsword" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" name="submit" class="btn" value="Login" required>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>