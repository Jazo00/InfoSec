<?php
include 'config.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $sql="SELECT studentNumber, firstName FROM users WHERE id=$id";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($result);
    $studentNumber = $row['studentNumber'];
    $firstName = $row['firstName'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Confirmation</title>
    <script>
        function confirmDelete(studentNumber, firstName) {
            return confirm("Are you sure you want to delete student with number " + studentNumber + " and name " + firstName + "?");
        }

        function cancelDelete() {
            window.location.href = "admin.php"; // Redirect to admin.php if cancel is clicked
        }

        function handleDelete(studentNumber, firstName) {
            if(confirmDelete(studentNumber, firstName)) {
                // Proceed with deletion
                window.location.href = "delete_admin.php?deleteid=<?php echo $id; ?>";
            } else {
                // Cancel deletion
                cancelDelete();
            }
        }
    </script>
</head>
<body onload="handleDelete('<?php echo $studentNumber; ?>', '<?php echo $firstName; ?>')">
</body>
</html>

<?php
}
?>
