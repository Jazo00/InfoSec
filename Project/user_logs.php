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
    <title>User Logs</title>

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
        <a class="p-2 text-dark" href="#">Home</a>
        <a class="p-2 text-dark" href="#">About Us</a>
        <a class="p-2 text-dark" href="#">Contact Us</a>
        <a class="p-2 text-dark" href="#">Features</a>
      </nav>
      <a class="btn btn-outline-primary" href="logout.php">Log Out</a>
    </div>

    <!--Filler for the Space-->
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">User Logs</h1>
      <p class="lead">User activity logs</p>
    </div>

    <!--Content of the Page-->
    <div class="container">
        <button class="btn btn-primary my-5"><a href="admin.php" class="text-light">
            Student Enrollment
        </a>
        </button>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Page</th>
                    <th scope="col">Activity</th>
                    <th scope="col">Student</th>
                    <th scope="col">User</th>
                </tr>
            </thead>
        <tbody>
            <?php
            $sql="SELECT l.created_at, l.page, l.action, s.student_firstname, s.student_lastname, u.name 
                  FROM `tbl_logs` as l
                  LEFT JOIN tbl_users as u ON u.id = l.user_id 
                  LEFT JOIN tbl_students as s ON s.id = l.student_id 
                  ORDER BY l.created_at DESC";

            $result=mysqli_query($conn, $sql);
            if($result){
                while($row=mysqli_fetch_assoc($result)){

                    $date = new DateTime($row['created_at']);
                    $humanReadableDate = $date->format('F j, Y g:i A');
                    echo "<tr>
                            <th scope='row'>".$humanReadableDate."</th>
                            <td>".$row['page']."</td>
                            <td>".$row['action']."</td>
                            <td>".$row['student_firstname']." ".$row['student_lastname']."</td>
                            <td><strong>".$row['name']."</strong></td>
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