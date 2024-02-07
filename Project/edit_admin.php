<?php
include 'config.php';

$id=$_GET['updateid'];
$sql="Select * from users where id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$studentNumber=$row['studentNumber'];
$firstName=$row['firstName'];
$middleInitial=$row['middleInitial'];
$lastName=$row['lastName'];
$emailAdd=$row['emailAdd'];
$courseEnrolled=$row['courseEnrolled'];
$password=$row['password'];

if(isset($_POST['submit'])){
  $studentNumber = $_POST['studentNumber'];
  $firstName = $_POST['firstName'];
  $middleInitial = $_POST['middleInitial'];
  $lastName = $_POST['lastName'];
  $emailAdd = $_POST['emailAdd'];
  $courseEnrolled = $_POST['courseEnrolled'];
  $password=$_POST['password'];

  //to prevent SQL injection
 
  $edit_query = mysqli_query($con,"UPDATE users SET studentNumber='$studentNumber', firstName='$firstName', middleInitial='$middleInitial', lastName='$lastName', emailAdd='$emailAdd', courseEnrolled='$courseEnrolled', password='$password' WHERE Id=$id ") or die("Error Occured");
  
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
                    <label for="courseEnrolled">Enrolled Course</label>
                    <select name="courseEnrolled" id="courseEnrolled" required> 
                        <option value="Choices">choose enrolled course</option>
                        <option value="BSIT">BSIT</option>
                        <option value="BSCS">BSCS</option>
                        <option value="BSML">BSML</option>
                        <option value="BSBM">BSBM</option>
                    </select>
                </div>
        <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" name="password" autocomplete="off" required value=<?php echo $password;?>>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>
    </div>

    <!--Footer of the Page-->
    <footer class="pt-4 my-md-5 pt-md-5 border-top">
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