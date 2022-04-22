<?php

session_start();
if(!isset($_SESSION['user'])){
    if($_SESSION['user'] !== "AdminUser_LoggedIn"){
        header('location: ../auth/login.php');
    }
}
