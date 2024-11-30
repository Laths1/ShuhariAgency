<?php
    session_start();
    if($_SESSION["admin"] == 1){
        header("Location: admin_dashboard.php");
    }else{
        header("Location: talent_dashboard.php");
    }
?>