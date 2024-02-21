<?php
session_start();
include 'config.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $sql="UPDATE tbl_students SET deleted_at=DATE(NOW()) WHERE id=$id";
    mysqli_query($conn,$sql);

    $logs = new UserLogs($conn);
    $logs->create('Admin Page', 'Delete Student Profile', $_SESSION['id'], $id);
}
header('location:admin.php');
?>

