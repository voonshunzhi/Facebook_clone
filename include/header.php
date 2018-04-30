<?php
    require "../config/config.php";
    if(isset($_SESSION['username']))
    {
        $user = $_SESSION['username'];
    }
    else
    {
        header("Location:register.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    
    <!-- Javascript   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    
    <!-- CSS  -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    
   <div class="topBar">
       <div class="logo">
           <a href="index.php">Swirlfeed!</a>
       </div>
   </div>