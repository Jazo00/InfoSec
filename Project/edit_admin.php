<?php

session_start();
include 'config.php';

$id=$_GET['updateid'];
$sql="SELECT 
        s.*, 
        c.id as course_id
      FROM tbl_students s
      LEFT JOIN tbl_courses c ON s.course_id = c.id
      WHERE s.id=$id";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$studentNumber=$row['student_number'];
$firstName=$row['student_firstname'];
$middleInitial=$row['student_mi'];
$lastName=$row['student_lastname'];
$emailAdd=$row['student_email'];
$courseEnrolled=$row['course_id'];
$studentStatus=$row['student_status'];

if(isset($_POST['submit'])){
  $studentNumber = $_POST['studentNumber'];
  $firstName = $_POST['firstName'];
  $middleInitial = $_POST['middleInitial'];
  $lastName = $_POST['lastName'];
  $emailAdd = $_POST['emailAdd'];
  $courseEnrolled = intval($_POST['courseEnrolled']);
  $studentStatus = intval($_POST['studentStatus']);

  //to prevent SQL injection
 
  $edit_query = mysqli_query($conn,"UPDATE tbl_students 
                                      SET 
                                        student_number='$studentNumber', 
                                        student_firstname='$firstName', 
                                        student_mi='$middleInitial', 
                                        student_lastname='$lastName', 
                                        student_email='$emailAdd', 
                                        course_id=$courseEnrolled,
                                        student_status=$studentStatus
                                    WHERE id=$id");
  
  $logs = new UserLogs($conn);
  $logs->create('Admin Page', 'Update Student Profile', $_SESSION['id'], $id);
  
  if ($edit_query) {
      header('location:admin.php');
  } else {
      die(mysqli_error($con));
  }
} 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <!--Manually-made CSS-->
    <link rel="stylesheet" href="admin.css">

    <title>Update Form</title>
  </head>
  <body>

    <!--Header with Navigation Bar-->
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">Company</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="#">Home</a>
        <a class="p-2 text-dark" href="#">About Us</a>
        <a class="p-2 text-dark" href="#">Contact Us</a>
        <a class="p-2 text-dark" href="#">Features</a>
      </nav>
      <a class="btn btn-outline-primary" href="logout.php">Log Out</a>
    </div>

    <!--Filler for the Space-->
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Student Profile</h1>
      <p class="lead">This is the student detail information.</p>
    </div>

    <!--Content of the Page-->
    <div class="container my-5">
    <form action="" method="POST">
        <div class="form-group">
            <label>Student Number</label>
            <input type="text" class="form-control" name="studentNumber" autocomplete="off" required value=<?php echo $studentNumber;?>>
        </div>
        <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" name="firstName" autocomplete="off" required value=<?php echo $firstName;?>>
        </div>
        <div class="form-group">
            <label>Middle Initial</label>
            <input type="text" class="form-control" name="middleInitial" autocomplete="off" value=<?php echo $middleInitial;?>>
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" name="lastName" autocomplete="off" required value=<?php echo $lastName;?>>
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="text" class="form-control" name="emailAdd" autocomplete="off" required value=<?php echo $emailAdd;?>>
        </div>
        <div class="form-group">
            <label for="courseEnrolled">Course Enrolled</label>
            <select class="form-control" name="courseEnrolled" id="courseEnrolled" required> 
                <option value="">choose enrolled course</option>
                <option value=1 <?php echo ($courseEnrolled == 1 ? 'selected="selected"' : '') ?>>BSIT</option>
                <option value=2 <?php echo ($courseEnrolled == 2 ? 'selected="selected"' : '') ?>>BSCS</option>
                <option value=3 <?php echo ($courseEnrolled == 3 ? 'selected="selected"' : '') ?>>BSML</option>
                <option value=4 <?php echo ($courseEnrolled == 4 ? 'selected="selected"' : '') ?>>BSBM</option>
            </select>
        </div>
        <div class="form-group">
            <label for="studentStatus">Status</label>
            <select class="form-control" name="studentStatus" id="studentStatus" required> 
                <option value=0 <?php echo ($studentStatus == 0 ? 'selected="selected"' : '') ?>>INACTIVE</option>
                <option value=1 <?php echo ($studentStatus == 1 ? 'selected="selected"' : '') ?>>ACTIVE</option>
            </select>
        </div>
        <div class="form-group float-right">
          <button type="submit" class="btn btn-warning" name="submit">Update</button>
          <a href="admin.php" class="btn btn-primary">Back</a>
        </div>
    </form>
    </div><br/>

    <!--Footer of the Page-->
    <footer class="mt-30 pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
          </div>
          <div class="col-6 col-md">
            <h5>Features</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Home</a></li>
              <li><a class="text-muted" href="#">Login</a></li>
              <li><a class="text-muted" href="#">Registration</a></li>
              <li><a class="text-muted" href="#">Charts</a></li>
              <li><a class="text-muted" href="#">View Tables</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>Links</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Facebook</a></li>
              <li><a class="text-muted" href="#">Instagram</a></li>
              <li><a class="text-muted" href="#">X</a></li>
              <li><a class="text-muted" href="#">LinkedIn</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>About</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Team</a></li>
              <li><a class="text-muted" href="#">Locations</a></li>
              <li><a class="text-muted" href="#">Privacy</a></li>
              <li><a class="text-muted" href="#">Terms</a></li>
            </ul>
          </div>
        </div>
      </footer>
  </body>
</html>