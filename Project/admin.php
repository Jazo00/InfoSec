<?php
    session_start();
    include("config.php");
    if(!isset($_SESSION['isAdmin'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Table</title>

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <!--Manually-made CSS-->
    <link rel="stylesheet" href="admin.css">

    <script>
        function confirmDelete(studentNumber, firstName) {
            return confirm("Are you sure you want to delete student with number " + studentNumber + " and name " + firstName + "?");
        }

        function cancelDelete() {
            window.location.href = "admin.php"; // Redirect to admin.php if cancel is clicked
        }

        function handleDelete(studentId, studentNumber, firstName) {
            if(confirmDelete(studentNumber, firstName)) {
                // Proceed with deletion
                window.location.href = "delete_admin.php?deleteid=" + studentId;
            } else {
                // Cancel deletion
                cancelDelete();
            }
        }
    </script>

</head>
<body>
    <!--Header with Navigation Bar-->
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">John University Admin</h5>
      <nav class="my-2 my-md-0 mr-md-3">
      <!--  <a class="p-2 text-dark" href="#">Home</a>
        <a class="p-2 text-dark" href="#">About Us</a>
        <a class="p-2 text-dark" href="#">Contact Us</a>
        <a class="p-2 text-dark" href="#">Features</a> -->
      </nav>
      <a class="btn btn-outline-primary" href="logout.php">Log Out</a>
    </div>

    <!--Filler for the Space-->
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Student Enrollment</h1>
      <p class="lead">Access the Record Table through this webpage.</p>
    </div>

    <!--Content of the Page-->
    <div class="container">
        <button class="btn btn-primary my-5"><a href="register.php" class="text-light">
            Add Student
        </a>
        </button>
        <button class="btn btn-primary my-5"><a href="user_logs.php" class="text-light">
            User Logs
        </a>
      </button>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Student Number</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Middle Initial</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Enrolled Course</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
        <tbody>
            <?php
            $sql="SELECT 
                      s.*, 
                      c.course_name
                  FROM tbl_students s
                  LEFT JOIN tbl_courses c ON s.course_id = c.id
                  WHERE s.deleted_at IS NULL";

            $result=mysqli_query($conn, $sql);
            if($result){
                while($row=mysqli_fetch_assoc($result)){
                    $id=$row['id']; //changed to id base sa database ko (change nalang to base sa database na gamit mo)
                    $studentNumber=$row['student_number'];
                    $firstName=$row['student_firstname'];
                    $middleInitial=$row['student_mi'];
                    $lastName=$row['student_lastname'];
                    $fullName=$firstName.' '.$lastName;
                    $courseEnrolled=$row['course_name'];
                    $studentStatus=$row['student_status'];

                    echo "<tr>
                            <th scope='row'>$id</th>
                            <td><strong>$studentNumber</strong></td>
                            <td>$firstName</td>
                            <td>$middleInitial</td>
                            <td>$lastName</td>
                            <td>$courseEnrolled</td>
                            <td>".($studentStatus > 0 ? 'ACTIVE' : 'INACTIVE')."</td>
                            <td>
                                <button class='btn btn-primary'><a href='edit_admin.php?updateid=$id' class='text-light'>Update</a></button>
                                <button class='btn btn-danger' onclick='handleDelete(".$id.",".$studentNumber.",\"".$fullName."\")' ".($studentStatus==1?'disabled':'').">Delete</button>
                            </td>
                        </tr>";
                }
            }
            ?>

        </tbody>
        </table>
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