<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-=UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
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

            $sql = "SELECT student_number FROM tbl_students WHERE student_number=?";
            $student = $conn->execute_query($sql, [$studentNumber])->fetch_assoc();

            if($student){
                echo "<div class='message'>
                        <p>Student Number is already taken, please try again.</p>
                    </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
            }
            else{

                try { 
                    $userSql = "INSERT INTO tbl_users (name, user_email, password) VALUES (?,?,?)";
                    $user = $conn->execute_query($userSql, [$firstName.' '.$lastName, $emailAdd, SHA1($password)]);

                    if($user) {
                        $studeSql = "INSERT INTO tbl_students(user_id, student_number, student_firstname, student_mi, student_lastName, student_email, course_id) 
                                        VALUES (?,?,?,?,?,?,?)";
                        $student = $conn->execute_query($studeSql, [$conn->insert_id, $studentNumber, strval($firstName), $middleInitial, strval($lastName), $emailAdd, $courseEnrolled]);

                        header('location:index.php');
                    }

                } 
                
                catch(Exception $e) {
                    echo "<div class='message'>
                            <p>Email address is already taken, please try again.</p>
                        </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                }
                
            }
        }
        else{

        ?>
            <header>Register</header>
            <form action="" method="post">
                <div class="form-group"> 
                    <label for="studentNumber">Student Number</label>
                    <input class="form-control" type="text" name="studentNumber" id="studentNumber" autocomplete="off" required>
                </div>   
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input class="form-control" type="text" name="firstName" id="firstName" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="middleInitial">Middle Initial</label>
                    <input class="form-control" type="text" name="middleInitial" id="middleInitial" autocomplete="off" required> <!---nagtanggal ka dito required add nalang pag need--->
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input class="form-control" type="text" name="lastName" id="lastName" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="emailAdd">Email Address</label>
                    <input class="form-control" type="email" name="emailAdd" id="emailAdd" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="courseEnrolled">Enrolled Course</label>
                    <select class="form-control" name="courseEnrolled" id="courseEnrolled" required> 
                        <option value="">choose enrolled course</option>
                        <option value=1>BSIT</option>
                        <option value=2>BSCS</option>
                        <option value=3>BSML</option>
                        <option value=4>BSBM</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input class="form-control btn btn-primary" type="submit" name="submit" value="Submit" required>
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