<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "marti");

    if(!isset($_SESSION['email'])) {
        header("Location: ../signin.php");
    }
    else{

    $id = $_SESSION['user'];
    $fullname = $_SESSION['fullname'];
    $mobile = $_SESSION['mobile'];
    $country = $_SESSION['country'];
    $role = $_SESSION['role'];

}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin</title>
       
         <link href="assets/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="assets/js/all.min.js"></script>
        
    </head>
    <body class="sb-nav-fixed">