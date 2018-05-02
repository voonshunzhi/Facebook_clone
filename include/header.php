<?php
    include "config/config.php";
    if(isset($_SESSION['username']))
    {
        $userLoggedIn = $_SESSION['username'];
        $user_details_query = mysqli_query($con,"SELECT * FROM users WHERE username = '$userLoggedIn'");
        $array = mysqli_fetch_array($user_details_query);
        $user_first_name = $array['first_name'];
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
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>
    
   <div class="topBar">
       <div class="logo">
           <a href="index.php">Swirlfeed!</a>
       </div>
       <nav>
           <a href="<?php echo $userLoggedIn; ?>" class="user_first_name">
               <?php echo $user_first_name; ?>
           </a>
          <a href="">
               <img src="assets/images/icons/icons8_New_Post_50px.png" alt="Home" title="">
           </a>
           <a href="">
               <img src="assets/images/icons/icons8_Home_50px_1.png" alt="Home">
           </a>
           <a href="">
               <img src="assets/images/icons/icons8_Notification_50px.png" alt="Notification">
           </a>
           <a href="">
               <img src="assets/images/icons/icons8_friends_50px_1.png" alt="Friend Request">
           </a>
           <a href="">
               <img src="assets/images/icons/icons8_Settings_50px.png" alt="Setting">
           </a>
           <a href="include/logout_handler.php">
               <img src="assets/images/icons/icons8_Exit_50px.png" alt="Exit">
           </a>
       </nav>
   </div>