<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-=UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">

        <?php

        include("config.php");
        if(isset($_POST['submit'])){
            $studentNumber = $_POST['studentNumber'];
            $firstName = $_POST['firstName'];
            $middleInitial = $_POST['middleInitial'];
            $lastName = $_POST['lastName'];
            $emailAdd = $_POST['emailAdd'];
            $courseEnrolled = $_POST['courseEnrolled'];
            $password = $_POST['password'];
        
        //Verifying the unique email

        $verify_query = mysqli_query($con, "SELECT studentNumber FROM users WHERE studentNumber='$studentNumber'");

        if(mysqli_num_rows($verify_query) !=0){
            echo "<div class='message'>
                    <p>This Student Number is already taken, Try another one please!</p>
                </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
        }
        else{

            mysqli_query($con, "INSERT INTO users(studentNumber,firstName,middleInitial,lastName,emailAdd,courseEnrolled,password) VALUES ('$studentNumber','$firstName','$middleInitial','$lastName','$emailAdd','$courseEnrolled', '$password')") or die("Error Occured");
            header('location:index.php');
        }
        }
        else{

        ?>
            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input"> 
                    <label for="studentNumber">Student Number</label>
                    <input type="text" name="studentNumber" id="studentNumber" autocomplete="off" required>
                </div>   
                <div class="field input">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="middleInitial">Middle Initial</label>
                    <input type="text" name="middleInitial" id="middleInitial" autocomplete="off"> <!---nagtanggal ka dito required add nalang pag need--->
                </div>
                <div class="field input">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" id="lastName" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="emailAdd">Email Address</label>
                    <input type="email" name="emailAdd" id="emailAdd" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="courseEnrolled">Enrolled Course</label>
                    <select name="courseEnrolled" id="courseEnrolled" required> 
                        <option value="Choices">choose enrolled course</option>
                        <option value="BSIT">BSIT</option>
                        <option value="BSCS">BSCS</option>
                        <option value="BSML">BSML</option>
                        <option value="BSBM">BSBM</option>
                    </select>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" name="submit" class="btn" value="Sign Up" required>
                </div>
                <div class="links">
                    Already have an account? <a href="login.php">Login Now</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>