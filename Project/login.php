<?php
    session_start();
    include("config.php");
    if(isset($_SESSION['valid'])){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-=UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php

            if(isset($_SESSION['valid'])){
                header("Location: index.php");
            }
            
            if(isset($_POST['submit'])){
                $email = mysqli_real_escape_string($conn,$_POST['emailAdd']);
                $password = mysqli_real_escape_string($conn,$_POST['password']);

                $hash_password = SHA1($password);

                $userResult = mysqli_query($conn,"SELECT id, user_email, user_type
                                              FROM tbl_users u
                                                WHERE u.user_email='$email' 
                                                    AND u.password='$hash_password'
                                                    AND u.deleted_at IS NULL");

                $userRow = mysqli_fetch_assoc($userResult);

                if(is_array($userRow) && !empty($userRow)){

                    if($userRow['user_type'] == 1) {
                        $_SESSION['id'] = $userRow['id'];
                        $_SESSION['isAdmin'] = $userRow['user_email'];

                        $logs = new UserLogs($conn);
                        $logs->create('Login Page', 'Admin User Login', $userRow['id'], 0);

                        header('location:admin.php');
                    }

                    $studentResult = mysqli_query($conn,"SELECT 
                                                students.*,
                                                courses.course_name
                                            FROM tbl_students students
                                            LEFT JOIN tbl_courses courses ON students.course_id = courses.id 
                                            WHERE students.user_id=".$userRow['id']." AND students.student_status=1 AND students.deleted_at IS NULL");
                    
                    $studentRow = mysqli_fetch_assoc($studentResult);

                     if(is_array($studentRow) && !empty($studentRow)){
                        $_SESSION['valid'] = $userRow['user_email'];
                        $_SESSION['firstName'] = $studentRow['student_firstname'];
                        $_SESSION['middleInitial'] = $studentRow['student_mi'];
                        $_SESSION['lastName'] = $studentRow['student_lastname'];
                        $_SESSION['courseEnrolled'] = $studentRow['course_name'];
                        $_SESSION['id'] = $studentRow['id'];

                        $logs = new UserLogs($conn);
                        $logs->create('Login Page', 'User Login', $userRow['id'], $studentRow['id']);

                        header('location:index.php');
                    } else {
                        echo "<div class='message'>
                            <p>Account Not Activated. Please again later.</p>
                        </div>";
                    }
                }else{
                    echo "<div class='message'>
                            <p>Incorrect Username or Password. Please try again.</p>
                        </div>";
                }
                
            } 
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="emailAdd" id="emailAdd" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" name="submit" class="btn" value="Login" required>
                </div>
                <div class="links">
                    Don't have an account yet? <a href="register.php">Register Now</a> | Go back to <a href="index.php">home page</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>