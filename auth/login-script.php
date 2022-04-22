<?php

//Get Active SQL Session
$con = '';
include '../dbo/dbConnect.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$password = md5($password);

//VERIFY VALUES NOT EMPTY
if(!empty($username) && !empty($password)){

    try {

        $data = $con->query("SELECT * FROM users WHERE username = '$username' and password = '$password'");

        if($data->rowCount() > 0){

            session_start();
            $_SESSION['user'] = "AdminUser_LoggedIn";

            echo json_encode(True);

        }else{

            echo json_encode(False);

        }
    } catch (Exception $ex) {

        echo $ex;

    }

}
