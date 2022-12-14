<?php

session_start();

include 'dbconnection.php';

if(isset($_GET['token'])){

    $token = $_GET['token'];

    $updatequery = " update registration set status='active' where token='$token' ";

    $query = mysqli_query($conn, $updatequery);

    if($query){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg'] = "Account updated successfully";
            header('location: login.php');
        } else{
            $_SESSION['msg'] = "You are logged out.";
            header('location: login.php');
        }
    } else{
        $_SESSION['msg'] = "Account not updated";
        header('location: registraion.php');
    }

}

?>