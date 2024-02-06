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
    <title>Login</title>
    
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php
            
            include("config.php");
            if(isset($_POST['submit'])){
                $email = mysqli_real_escape_string($con,$_POST['emailAdd']);
                $studentNum = mysqli_real_escape_string($con,$_POST['studentNumber']);

                $result = mysqli_query($con,"SELECT * FROM users WHERE emailAdd='$email' AND studentNumber='$studentNum' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['emailAdd'];
                    $_SESSION['firstName'] = $row['firstName'];
                    $_SESSION['middleInitial'] = $row['middleInitial'];
                    $_SESSION['lastName'] = $row['lastName'];
                    $_SESSION['courseEnrolled'] = $row['courseEnrolled'];
                    $_SESSION['enrollStatus'] = $row['enrollStatus'];
                    $_SESSION['id'] = $row['iD'];
                }else{
                    echo "<div class='message'>
                            <p>Wrong Username or Password. Please try again!</p>
                        </div> <br>";
                    echo "<a href='login.php'><button class='btn'>Go Back</button>";
                }
                if(isset($_SESSION['valid'])){
                    header("Location: home.php");
                }
            } else{


            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="emailAdd" id="emailAdd" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Student Number</label>
                    <input type="password" name="studentNumber" id="studentNumber" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" name="submit" class="btn" value="Login" required>
                </div>
                <div class="links">
                    Don't have an account yet? <a href="register.php">Sign Up Now</a>
                </div>
                <div class="links">
                    Not a Student? <a href="login_admin.php">Login as Admin</a>
                </div>
                <div class="links">
                    <a href="index.php">Go back to home page</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>