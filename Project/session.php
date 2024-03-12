<?php

    session_start();
    include('config.php');
    if(isset($_SESSION['valid'])){
        header("Location: index.php");
    } 

    if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > 1800){
        session_unset();
        session_destroy();
    }
    $_SESSION['LAST_ACTIVITY'] = time();
?>