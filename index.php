<?php
    require "config/config.php";
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
</head>
<body>
    
</body>
</html>