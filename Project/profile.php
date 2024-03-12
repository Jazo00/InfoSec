<?php
    include("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-=UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
        <a href="index.php">Logo</button></a>
        </div>

        <div class="right-links">
        <a href="index.php">Home</button></a>
        <?php

        $id = $_SESSION['id'];
        $query = mysqli_query($conn,"SELECT 
                                        s.*, 
                                        c.course_name
                                    FROM tbl_students s
                                    LEFT JOIN tbl_courses c ON s.course_id = c.id
                                    WHERE s.id=$id"); 

        while($result = mysqli_fetch_assoc($query)){
            $res_studentNumber = $result['student_number'];
            $res_firstName = $result['student_firstname'];
            $res_middleInitial = $result['student_mi'];
            $res_lastName = $result['student_lastname'];
            $res_courseEnrolled = $result['course_name'];
      
        }

        echo "<a href='edit.php?studentNumber=$res_studentNumber'>Change Profile</a>";
        ?>

            <a href="logout.php"><button class="btn">Logout</button></a>
        </div>
    </div>
    <main>

        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Hello <b><?php echo $res_lastName;?></b>, <b><?php echo $res_firstName; ?></b> <b><?php echo $res_middleInitial; ?></b>  Welcome</p>
                </div>
                <div class="box">
                    <p>Your Student Number is <b><?php echo $res_studentNumber; ?>.</p>
                </div>
            </div>
            <div class="bottom">
                <div class="box">
                    <p>And you are enrolled in <b><?php echo $res_courseEnrolled; ?></b>.</p>
                </div>
                <!---<div class="box">
                    <p>And you are <b></b>.</p>
                </div>-->
            </div>
        </div>

    </main>
</body>
</html>