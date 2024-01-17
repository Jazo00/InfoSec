<?php
include 'config.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Confirmation</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this row?");
        }
    </script>
</head>
<body>

<?php
    // Display the confirmation prompt using JavaScript
    echo '<script>if(confirmDelete()) {';
    
    $sql = "DELETE FROM users WHERE iD = $id";
    $result = mysqli_query($con, $sql);
    
    if($result){
        echo 'window.location.href = "admin.php";';
    } else {
        die(mysqli_error($con));
    }
    echo '} else { window.location.href = "admin.php"; }</script>';
?>
</body>
</html>

<?php
}
?>