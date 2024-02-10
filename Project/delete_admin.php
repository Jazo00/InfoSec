<?php
include 'config.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $sql="UPDATE tbl_students SET deleted_at=DATE(NOW()) WHERE id=$id";
    mysqli_query($conn,$sql);
}
header('location:admin.php');
?>

