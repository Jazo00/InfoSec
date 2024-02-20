<?php
    session_start();

    include("config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-=UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Change Profile</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p> <a href="index.php">Logo</a></p>
        </div>

        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href="logout.php"><button class="btn">Logout</button></a>
        </div>
    </div>

    <div class="container">
        <div class="box form-box">
            <?php
                if(isset($_POST['submit'])){
                    $studentNumber = $_POST['studentNumber'];
                    $firstName = $_POST['firstName'];
                    $middleInitial = $_POST['middleInitial'];
                    $lastName = $_POST['lastName'];
                    $courseEnrolled = $_POST['courseEnrolled'];
                    

                    $id = $_SESSION['id'];

                    $edit_query = mysqli_query($conn,"UPDATE tbl_students 
                                                        SET student_number='$studentNumber', 
                                                        student_firstname='$firstName', 
                                                        student_mi='$middleInitial', 
                                                        student_lastname='$lastName', 
                                                        course_id='$courseEnrolled' 
                                                    WHERE id=$id") or die("Error Occured");
                    
                    if($edit_query){
                        echo "<div class='message'>
                                <p>Your Profile is Up to date!</p>
                            </div> <br>";
                        echo "<a href='index.php'><button class='btn'>Go Home</button>";
                        }
                } else{
                    $id = $_SESSION['id'];
                    $query = mysqli_query($conn,"SELECT 
                                                    students.*, 
                                                    courses.id as course_id
                                                FROM tbl_students students
                                                LEFT JOIN tbl_courses courses ON students.course_id = courses.id
                                                WHERE students.id=$id");

                    while($result = mysqli_fetch_assoc($query)){
                        $res_studentNumber = $result['student_number'];
                        $res_firstName = $result['student_firstname'];
                        $res_middleInitial = $result['student_mi'];
                        $res_lastName = $result['student_lastname'];
                        $res_emailAdd = $result['student_email'];
                        $res_courseEnrolled = $result['course_id'];
                    }
            ?>
            <header>Edit Profile</header>
            <form action="" method="post">
            <div class="field input"> 
                    <label for="studentNumber">Student Number</label>
                    <input type="text" name="studentNumber" id="studentNumber" autocomplete="off" required value="<?php echo $res_studentNumber ?>">
                </div>   
                <div class="field input">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName" autocomplete="off" required value="<?php echo $res_firstName ?>">
                </div>
                <div class="field input">
                    <label for="middleInitial">Middle Initial</label>
                    <input type="text" name="middleInitial" id="middleInitial" autocomplete="off" required value="<?php echo $res_middleInitial ?>">
                </div>
                <div class="field input">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" id="lastName" autocomplete="off" required value="<?php echo $res_lastName ?>">
                </div>
                <div class="field input">
                    <label for="emailAdd">Email Address</label>
                    <input type="email" name="emailAdd" id="emailAdd" autocomplete="off" disabled value="<?php echo $res_emailAdd ?>">
                </div>
                <br>
                <div class="form-group">
                    <label for="courseEnrolled">Enrolled Course</label>
                    <select name="courseEnrolled" class="form-control" id="courseEnrolled" required> 
                        <option value="">choose enrolled course</option>
                        <option value=1 <?php echo ($res_courseEnrolled == 1 ? 'selected="selected"' : '') ?>>BSIT</option>
                        <option value=2 <?php echo ($res_courseEnrolled == 2 ? 'selected="selected"' : '') ?>>BSCS</option>
                        <option value=3 <?php echo ($res_courseEnrolled == 3 ? 'selected="selected"' : '') ?>>BSML</option>
                        <option value=4 <?php echo ($res_courseEnrolled == 4 ? 'selected="selected"' : '') ?>>BSBM</option>
                    </select>
                </div>
                <br>
                <div class="form-group float-right">
                    <input type="submit" name="submit" class="btn btn-warning" value="Update" required>
                    <a href="profile.php" class="btn">Back</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>